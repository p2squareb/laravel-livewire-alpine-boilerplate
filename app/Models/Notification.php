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
 * @property string $message 알림 내용
 * @property int $receive_id 수신자 users.id
 * @property string $receive_nickname 수신자 users.nickname
 * @property int $send_id 발신자 users.id
 * @property string $send_nickname 발신자 users.nickname
 * @property string $refer_url 참조 링크
 * @property int $is_read 읽음 여부
 * @property string|null $read_at 읽은 시간
 * @property-read User|null $user
 * @method static Builder|Notification newModelQuery()
 * @method static Builder|Notification newQuery()
 * @method static Builder|Notification query()
 * @method static Builder|Notification whereCreatedAt($value)
 * @method static Builder|Notification whereId($value)
 * @method static Builder|Notification whereIsRead($value)
 * @method static Builder|Notification whereMessage($value)
 * @method static Builder|Notification whereReadAt($value)
 * @method static Builder|Notification whereReceiveId($value)
 * @method static Builder|Notification whereReceiveNickname($value)
 * @method static Builder|Notification whereReferUrl($value)
 * @method static Builder|Notification whereSendId($value)
 * @method static Builder|Notification whereSendNickname($value)
 * @method static Builder|Notification whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Notification extends Model
{
    protected $fillable = [
        'message',
        'receive_id',
        'receive_nickname',
        'send_id',
        'send_nickname',
        'is_read',
        'read_at',
        'refer_url',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receive_id', 'id');
    }
}
