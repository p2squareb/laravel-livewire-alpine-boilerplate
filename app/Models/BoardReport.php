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
 * @property string $table_id board.table_id
 * @property int|null $write_id writes.id
 * @property int|null $comment_id comments.id
 * @property int|null $user_id users.id
 * @property string|null $field 신고 항목
 * @property int|null $target_user_id users.id
 * @property int $status 처리 여부
 * @property string|null $title 타이틀
 * @property string|null $refer_url 참조 링크
 * @property-read Board $board
 * @property-read BoardComment|null $comment
 * @property-read User|null $user
 * @property-read BoardWrite|null $write
 * @method static Builder|BoardReport newModelQuery()
 * @method static Builder|BoardReport newQuery()
 * @method static Builder|BoardReport query()
 * @method static Builder|BoardReport whereBoardId($value)
 * @method static Builder|BoardReport whereCommentId($value)
 * @method static Builder|BoardReport whereCreatedAt($value)
 * @method static Builder|BoardReport whereField($value)
 * @method static Builder|BoardReport whereId($value)
 * @method static Builder|BoardReport whereReferUrl($value)
 * @method static Builder|BoardReport whereStatus($value)
 * @method static Builder|BoardReport whereTableId($value)
 * @method static Builder|BoardReport whereTargetUserId($value)
 * @method static Builder|BoardReport whereTitle($value)
 * @method static Builder|BoardReport whereUpdatedAt($value)
 * @method static Builder|BoardReport whereUserId($value)
 * @method static Builder|BoardReport whereWriteId($value)
 * @mixin Eloquent
 */
class BoardReport extends Model
{
    protected $fillable = [
        'field',
        'title',
    ];

    protected $hidden = [];

    protected $guarded = [
        'board_id',
        'table_id',
        'write_id',
        'comment_id',
        'user_id',
        'target_user_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function write(): BelongsTo
    {
        return $this->belongsTo(BoardWrite::class, 'write_id', 'id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(BoardComment::class, 'comment_id', 'id');
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }

    public function target(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_user_id', 'id');
    }
}
