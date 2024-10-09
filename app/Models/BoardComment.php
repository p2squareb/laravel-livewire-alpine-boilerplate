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
 * @property int $board_id boards.id
 * @property string $table_id boards.table_id
 * @property int $write_id writes.id
 * @property int|null $parent_id parent comments.id
 * @property int|null $depth depth
 * @property int $rate_up 추천 수
 * @property int $rate_down 비추천 수
 * @property int|null $user_id users.id
 * @property string|null $writer 작성자
 * @property string $comment 댓글 내용
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제 시간
 * @property int $is_reported 신고 여부
 * @property string $ip 작성자 아이피
 * @property-read Board $board
 * @property-read User|null $user
 * @property-read BoardWrite|null $write
 * @method static Builder|BoardComment newModelQuery()
 * @method static Builder|BoardComment newQuery()
 * @method static Builder|BoardComment query()
 * @method static Builder|BoardComment whereBoardId($value)
 * @method static Builder|BoardComment whereComment($value)
 * @method static Builder|BoardComment whereCreatedAt($value)
 * @method static Builder|BoardComment whereDeletedAt($value)
 * @method static Builder|BoardComment whereDepth($value)
 * @method static Builder|BoardComment whereId($value)
 * @method static Builder|BoardComment whereIp($value)
 * @method static Builder|BoardComment whereIsDelete($value)
 * @method static Builder|BoardComment whereIsReported($value)
 * @method static Builder|BoardComment whereParentId($value)
 * @method static Builder|BoardComment whereRateDown($value)
 * @method static Builder|BoardComment whereRateUp($value)
 * @method static Builder|BoardComment whereTableId($value)
 * @method static Builder|BoardComment whereUpdatedAt($value)
 * @method static Builder|BoardComment whereUserId($value)
 * @method static Builder|BoardComment whereWriteId($value)
 * @method static Builder|BoardComment whereWriter($value)
 * @mixin Eloquent
 */
class BoardComment extends Model
{
    protected $fillable = [
        'write_id',
        'comment',
        'password',
        'writer',
    ];

    protected $hidden = [];

    protected $guarded = [
        'board_id',
        'table_id',
        'parent_id',
        'depth',
        'user_id',
        'ip',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function write(): BelongsTo
    {
        return $this->belongsTo(BoardWrite::class, 'write_id', 'id');
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }
}
