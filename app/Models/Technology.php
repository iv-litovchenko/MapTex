<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    use HasFactory;

    protected $table = 'technologies';
//    protected $fillable = false;

    const BRUNCH_LEFT_CODE = 1;
    const BRUNCH_RIGHT_CODE = 2;
    const BRUNCH_STOP_CODE = 1;

// TODO Поля таблицы (интересный способ)
// where(Technology::FIELD_NAME,'=','foo')
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_DESCRIPTION = 'description';

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $parentId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereParentId($query, $parentId)
    {
        if (intval($parentId) > 0) {
            return $query->where('parent_id', '!=', $parentId);
        }
        return $query->whereNull('parent_id');
    }

    public function scopeWhere($query)
    {
        return $query->where('votes', '>', 100);
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
