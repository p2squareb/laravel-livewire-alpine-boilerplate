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
 * @property string $point_type P:플러스, M:마이너스
 * @property string $point_item 지급/차감 명목
 * @property int $to_user_id 포인트 받는 회원의 users.id
 * @property int $from_user_id 포인트 지급/차감 발생시킨 회원의 users.id
 * @property string $reason 사유
 * @property int $amount 포인트
 * @property string $target_table_name target table name
 * @property int|null $target_id target id
 * @property string $processed_by 처리자
 * @property-read User|null $user
 * @method static Builder|Point newModelQuery()
 * @method static Builder|Point newQuery()
 * @method static Builder|Point query()
 * @method static Builder|Point whereAmount($value)
 * @method static Builder|Point whereCreatedAt($value)
 * @method static Builder|Point whereFromUserId($value)
 * @method static Builder|Point whereId($value)
 * @method static Builder|Point wherePointItem($value)
 * @method static Builder|Point wherePointType($value)
 * @method static Builder|Point whereProcessedBy($value)
 * @method static Builder|Point whereReason($value)
 * @method static Builder|Point whereTargetId($value)
 * @method static Builder|Point whereTargetTableName($value)
 * @method static Builder|Point whereToUserId($value)
 * @method static Builder|Point whereUpdatedAt($value)
 * @property-read \App\Models\User|null $sender
 * @mixin Eloquent
 */
class Point extends Model
{
    protected $fillable = [
        'point_type',
        'point_item',
        'to_user_id',
        'from_user_id',
        'reason',
        'amount',
        'target_table_name',
        'target_id',
        'processed_by',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }
}
