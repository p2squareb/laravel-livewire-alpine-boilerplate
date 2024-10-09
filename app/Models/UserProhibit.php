<?php

namespace App\Models;

use Eloquent;
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
 * @property int $gubun 1:이용정지, 0:이용정지 해제
 * @property string $period_type 이용정지 기간
 * @property string $until_date 정지 기간 종료일
 * @property string|null $cause 사유
 * @property int $processed_by_user_id 처리 관리자 users.id
 * @property string $processed_by_user_nickname 처리 관리자 users.nickname
 * @property-read User|null $user
 * @method static Builder|UserProhibit newModelQuery()
 * @method static Builder|UserProhibit newQuery()
 * @method static Builder|UserProhibit query()
 * @method static Builder|UserProhibit whereCause($value)
 * @method static Builder|UserProhibit whereCreatedAt($value)
 * @method static Builder|UserProhibit whereGubun($value)
 * @method static Builder|UserProhibit whereId($value)
 * @method static Builder|UserProhibit wherePeriodType($value)
 * @method static Builder|UserProhibit whereProcessedByUserId($value)
 * @method static Builder|UserProhibit whereProcessedByUserNickname($value)
 * @method static Builder|UserProhibit whereUntilDate($value)
 * @method static Builder|UserProhibit whereUpdatedAt($value)
 * @method static Builder|UserProhibit whereUserId($value)
 * @mixin Eloquent
 */
class UserProhibit extends Model
{
    protected $fillable = [
        'user_id',
        'gubun',
        'period_type',
        'until_date',
        'cause',
        'processed_by_user_id',
        'processed_by_user_nickname',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
