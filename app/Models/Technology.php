<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Kalnoy\Nestedset\NodeTrait;
use App\Models\User;

/**
 * App\Models\Technology
 *
 * @property int $id
 * @property int $branch_type
 * @property int $branch_stop_flag
 * @property int $is_page_flag
 * @property int $is_draft_flag
 * @property int $parent_id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $description_tinymce
 * @property int $sorting
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TechnologyFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Technology newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Technology query()
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereBranchStopFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereBranchType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereDescriptionTinymce($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereIsDraftFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereIsPageFlag($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereSorting($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Technology whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Technology extends Model
{
    use HasFactory, NodeTrait;

    protected $table = 'technologies';
    // protected $fillable = false;

    const BRUNCH_LEFT_CODE = 1;
    const BRUNCH_RIGHT_CODE = 2;
    const BRUNCH_STOP_CODE = 1;

    // TODO Поля таблицы (интересный способ)
    // where(Technology::FIELD_NAME,'=','foo')
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_DESCRIPTION = 'description';

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
        $table->integer('branch_type')->default(0);
        $table->integer('branch_stop_flag')->default(0);
        $table->integer('is_page_flag')->default(0);
        $table->integer('is_draft_flag')->default(0);
        $table->unsignedBigInteger('user_id')->nullable();
        $table->string('name')->nullable();
        $table->string('slug')->nullable();
        $table->text('description')->nullable();
        $table->text('description_tinymce')->nullable();
        $table->text('logo_image')->nullable();
        $table->integer('sorting')->default(0);
        $table->integer('sorting3')->default(0);
        $table->timestamps();

        Schema::hasColumn('')
        $table->hasC
            // TODO нужно проверить сущестование индекса...
        # $table->index('user_id', 'technology_user_idx');
        # $table->foreign('user_id', 'technology_user_fk')->on('users')->references('id');

        // TODO последовательность удаления важна!
        // $table->dropForeign('technology_parent_fk');
        // $table->dropIndex('technology_parent_idx');

        // TODO последовательность удаления важна!
        // $table->dropForeign('technology_user_fk');
        // $table->dropIndex('technology_user_idx');
        // $table->dropColumn('user_id');
    }

    /**
     * Scope a query
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param null|int $parentId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereParentIdWithNull($query, $parentId)
    {
        // TODO пользовательское условие!
        if (intval($parentId) > 0) {
            return $query->where('parent_id', '=', $parentId);
        }
        return $query->whereNull('parent_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function parentsAll()
    {
        //         return $this->hasMany ... self::class
    }

    public function parent()
    {
        // return $this->hasMany ... self::class
    }

    public function childrens()
    {
        // return $this->hasMany ... self::class
    }
}
