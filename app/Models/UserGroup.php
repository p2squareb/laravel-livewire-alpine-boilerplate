<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $name 그룹명
 * @property int $level 그룹 레벨
 * @property string|null $comment 메모
 * @property-read Collection<int, User> $users
 * @property-read int|null $users_count
 * @method static Builder|UserGroup newModelQuery()
 * @method static Builder|UserGroup newQuery()
 * @method static Builder|UserGroup query()
 * @method static Builder|UserGroup whereComment($value)
 * @method static Builder|UserGroup whereCreatedAt($value)
 * @method static Builder|UserGroup whereId($value)
 * @method static Builder|UserGroup whereLevel($value)
 * @method static Builder|UserGroup whereName($value)
 * @method static Builder|UserGroup whereUpdatedAt($value)
 * @mixin Eloquent
 */
class UserGroup extends Model
{
    protected $fillable = [
        'name',
        'level',
        'comment',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'group_level', 'level');
    }
}
