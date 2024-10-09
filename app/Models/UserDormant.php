<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $user_id users.id
 * @property int $gubun 1:휴면, 0:휴면 해제
 * @property-read User|null $user
 * @method static Builder|UserDormant newModelQuery()
 * @method static Builder|UserDormant newQuery()
 * @method static Builder|UserDormant query()
 * @method static Builder|UserDormant whereCreatedAt($value)
 * @method static Builder|UserDormant whereGubun($value)
 * @method static Builder|UserDormant whereId($value)
 * @method static Builder|UserDormant whereUpdatedAt($value)
 * @method static Builder|UserDormant whereUserId($value)
 * @mixin \Eloquent
 */
class UserDormant extends Model
{
    protected $fillable = [
        'user_id',
        'gubun',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
