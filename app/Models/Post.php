<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Traits\HasRoles;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property int $branch_type
 * @property int $branch_stop_flag
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $slug
 * @property string|null $description
 * @property string|null $description_tinymce
 * @property string|null $logo_image
 * @property int $sorting
 * @property int $sorting3
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|Post[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\User|null $users
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereBranchStopFlag($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereBranchType($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescription($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereDescriptionTinymce($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsDraftFlag($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsPageFlag($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereLogoImage($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereParentIdWithNull($parentId)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereSlug($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereSorting($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereSorting3($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post whereUserId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Post withoutRoot()
 * @mixin \Eloquent
 */
class Post extends Model
{
    use HasFactory, NodeTrait;

    // HasRoles

    protected $table = 'posts';
    // protected $fillable = false;

    const BRUNCH_LEFT_CODE = 1;
    const BRUNCH_RIGHT_CODE = 2;
    const BRUNCH_STOP_CODE = 1;
    const POST_TYPE = [
        'directory' => 'Раздел',
        'page' => 'Страница',
        'page-cheat-sheet' => 'Шпаргалка',
        'page-figma' => 'Зарисовка',
        'page-mind-map' => 'Карта (mindmap)'
    ];

    // TODO Поля таблицы (интересный способ)
    // where(Post::FIELD_NAME,'=','foo')
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
        $table->char('post_type', 20)->default('page');
        $table->integer('branch_type')->default(0);
        $table->integer('branch_stop_flag')->default(0);

        #$table->foreignId('user_id', 'fewfew')->nullable()->constrained('users');
        $table->integer('user_id')->nullable();
        #$table->index('user_id');  // <--------

        $table->string('name')->nullable();
        $table->string('slug')->nullable();
        $table->text('description')->nullable();
        $table->char('logo_image', 255)->nullable();
        $table->char('figma_image', 255)->nullable();
        $table->integer('sorting')->default(0);
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
