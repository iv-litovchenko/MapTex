<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\Models\Technology
 *
 * @property int $id
 * @property int $_lft
 * @property int $_rgt
 * @property int|null $parent_id
 * @property int $branch_type
 * @property int $branch_stop_flag
 * @property int $is_page_flag
 * @property int $is_draft_flag
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
 * @property-read \Kalnoy\Nestedset\Collection|Technology[] $children
 * @property-read int|null $children_count
 * @property-read \App\Models\User|null $users
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology ancestorsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology ancestorsOf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology applyNestedSetScope(?string $table = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology countErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology d()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology defaultOrder(string $dir = 'asc')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology descendantsAndSelf($id, array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology descendantsOf($id, array $columns = [], $andSelf = false)
 * @method static \Database\Factories\TechnologyFactory factory(...$parameters)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology fixSubtree($root)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology fixTree($root = null)
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology getNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology getPlainNodeData($id, $required = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology getTotalErrors()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology hasChildren()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology hasParent()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology isBroken()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology leaves(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology makeGap(int $cut, int $height)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology moveNode($key, $position)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology orWhereAncestorOf(bool $id, bool $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology orWhereDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology orWhereNodeBetween($values)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology orWhereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology query()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology rebuildSubtree($root, array $data, $delete = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology rebuildTree(array $data, $delete = false, $root = null)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology reversed()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology root(array $columns = [])
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereAncestorOf($id, $andSelf = false, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereAncestorOrSelf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereBranchStopFlag($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereBranchType($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereCreatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereDescription($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereDescriptionTinymce($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereIsAfter($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereIsBefore($id, $boolean = 'and')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereIsDraftFlag($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereIsLeaf()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereIsPageFlag($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereIsRoot()
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereLft($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereLogoImage($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereName($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereNodeBetween($values, $boolean = 'and', $not = false)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereNotDescendantOf($id)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereParentId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereParentIdWithNull($parentId)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereRgt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereSlug($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereSorting($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereSorting3($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereUpdatedAt($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology whereUserId($value)
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology withDepth(string $as = 'depth')
 * @method static \Kalnoy\Nestedset\QueryBuilder|Technology withoutRoot()
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
        $table->timestamps();

        // TODO добавление индекса...
        $table->index('user_id', 'technology_user_idx');
        // if (Schema::hasTable('users')) {
        //    $table->foreign('user_id', 'technology_user_fk')
        //        ->references('id')
        //        ->on('users');
        // }

        // TODO [не актуально!] в обычных миграциях последовательность удаления важна!
        // $table->dropForeign('technology_user_fk');
        // $table->dropIndex('technology_user_idx');
        // $table->dropColumn('user_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
