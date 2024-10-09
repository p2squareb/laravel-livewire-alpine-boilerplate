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
 * @property string $rate 추천 여부
 * @property int|null $target_user_id users.id
 * @property-read Board $board
 * @property-read User|null $user
 * @method static Builder|BoardRate newModelQuery()
 * @method static Builder|BoardRate newQuery()
 * @method static Builder|BoardRate query()
 * @method static Builder|BoardRate whereBoardId($value)
 * @method static Builder|BoardRate whereCommentId($value)
 * @method static Builder|BoardRate whereCreatedAt($value)
 * @method static Builder|BoardRate whereId($value)
 * @method static Builder|BoardRate whereRate($value)
 * @method static Builder|BoardRate whereTableId($value)
 * @method static Builder|BoardRate whereTargetUserId($value)
 * @method static Builder|BoardRate whereUpdatedAt($value)
 * @method static Builder|BoardRate whereUserId($value)
 * @method static Builder|BoardRate whereWriteId($value)
 * @mixin Eloquent
 */
class BoardRate extends Model
{
    protected $fillable = [
        'rate',
    ];

    protected $hidden = [];

    protected $guarded = [
        'board_id',
        'table_id',
        'write_id',
        'comment_id',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function board(): BelongsTo
    {
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }
}
