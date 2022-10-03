<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Traits\HasRoles;
use Kalnoy\Nestedset\NodeTrait;
use Antonrom\ModelChangesHistory\Traits\HasChangesHistory;

/**
 * ...
 */
class Post extends Model
{
    use HasFactory, NodeTrait, HasChangesHistory;

    // HasRoles

    protected $table = 'posts';
    // protected $fillable = false;

    const BRUNCH_LEFT_CODE = 1;
    const BRUNCH_RIGHT_CODE = 2;
    const BRUNCH_STOP_CODE = 1;
    const POST_TYPE = [
        'directory' => 'Раздел (папка)',
        'page' => 'Страница',
        'page-figma' => 'Страница: зарисовка (figma)',
        'page-cheat-sheet' => 'Страница: шпаргалка (sheet)',
        'page-mind-map' => 'Страница: карта разума (mindmap)'
    ];

    // TODO Поля таблицы (интересный способ)
    // where(Post::FIELD_NAME,'=','foo')
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_DESCRIPTION = 'description';

    const STUDY_STATUS_0 = 0;
    const STUDY_STATUS_1 = 1;
    const STUDY_STATUS_2 = 2;
    const STUDY_STATUS_3 = 3;

    static public function getStudyStatusOptions()
    {
        return [
            self::STUDY_STATUS_0 => 'Без статуса',
            self::STUDY_STATUS_1 => 'Углубиться',
            self::STUDY_STATUS_2 => 'Можно использовать',
            self::STUDY_STATUS_3 => 'К изучению'
        ];
    }

    static public function getStudyStatusMapper()
    {
        return [
            self::STUDY_STATUS_0 => '',
            self::STUDY_STATUS_1 => 'info',
            self::STUDY_STATUS_2 => 'success',
            self::STUDY_STATUS_3 => 'warning'
        ];
    }

    /**
     * Run the migrations.
     *
     * @param Blueprint $table
     * @return void
     */
    public function migration(Blueprint $table)
    {
        $table->id();
        $table->nestedSet();
        $table->char('post_type', 24)->default('page');
        $table->integer('branch_type')->default(0);

        #$table->foreignId('user_id', 'fewfew')->nullable()->constrained('users');
        $table->integer('user_id')->nullable();
        #$table->index('user_id');  // <--------

        $table->string('name')->nullable();
        $table->string('name_short')->nullable();
        $table->string('slug')->nullable();
        $table->text('description')->nullable();
        $table->char('logo_image', 255)->nullable();
        $table->char('figma_image', 255)->nullable();
        $table->char('figma_file', 255)->nullable();
        $table->text('post_images')->nullable();
        $table->integer('sorting')->default(0);
        $table->string('maptex_content_link', 255)->nullable();
        $table->text('maptex_content_save')->nullable();
        $table->integer('study_status')->default(0);
        $table->integer('is_protected')->default(0);

        $table->timestamps();

        // TODO добавление индекса...
        // $table->index('user_id', 'tu_idx');
        // TODO важно! именование индекса во множественном числе!
        if (Schema::hasTable('users')) {
            # $table->foreign('user_id')
            # ->references('id')
            # ->on('users');
        }

        // TODO [не актуально!] в обычных миграциях последовательность удаления важна!
        // $table->dropForeign('post_user_fk');
        // $table->dropIndex('post_user_idx');
        // $table->dropColumn('user_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
