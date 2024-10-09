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
 * @property int $board_id tbl.boards.id
 * @property string $table_id 테이블 아이디
 * @property string|null $categories 카테고리
 * @property int $is_notice 공지글 여부
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제일시
 * @property string $subject 제목
 * @property string $content 내용
 * @property int $hit 조회수
 * @property int $rate_up 추천 수
 * @property int $rate_down 비추천 수
 * @property int $comment_count 댓글 수
 * @property int|null $user_id 작성자 회원 인덱스
 * @property string|null $password 비밀번호
 * @property string|null $writer 작성자
 * @property int $has_image 본문에 이미지 포함 여부
 * @property int $has_video 본문에 영상 포함 여부
 * @property string $ip 작성자 아이피
 * @property string|null $list_file 목록 첨부파일
 * @property-read Board $board
 * @property-read User|null $user
 * @method static Builder|BoardWrite newModelQuery()
 * @method static Builder|BoardWrite newQuery()
 * @method static Builder|BoardWrite query()
 * @method static Builder|BoardWrite whereBoardId($value)
 * @method static Builder|BoardWrite whereCategories($value)
 * @method static Builder|BoardWrite whereCommentCount($value)
 * @method static Builder|BoardWrite whereContent($value)
 * @method static Builder|BoardWrite whereCreatedAt($value)
 * @method static Builder|BoardWrite whereDeletedAt($value)
 * @method static Builder|BoardWrite whereHasImage($value)
 * @method static Builder|BoardWrite whereHasVideo($value)
 * @method static Builder|BoardWrite whereHit($value)
 * @method static Builder|BoardWrite whereId($value)
 * @method static Builder|BoardWrite whereIp($value)
 * @method static Builder|BoardWrite whereIsDelete($value)
 * @method static Builder|BoardWrite whereIsNotice($value)
 * @method static Builder|BoardWrite whereListFile($value)
 * @method static Builder|BoardWrite wherePassword($value)
 * @method static Builder|BoardWrite whereRateDown($value)
 * @method static Builder|BoardWrite whereRateUp($value)
 * @method static Builder|BoardWrite whereSubject($value)
 * @method static Builder|BoardWrite whereTableId($value)
 * @method static Builder|BoardWrite whereUpdatedAt($value)
 * @method static Builder|BoardWrite whereUserId($value)
 * @method static Builder|BoardWrite whereWriter($value)
 * @mixin Eloquent
 */
class BoardWrite extends Model
{
    protected $fillable = [
        'categories',
        'is_notice',
        'is_delete',
        'subject',
        'content',
        'password',
        'writer',
    ];

    protected $hidden = [];

    protected $guarded = [
        'tid',
        'table_id',
        'hit',
        'rate_up',
        'rate_down',
        'user_id',
        'ip',
        'comment_count',
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
