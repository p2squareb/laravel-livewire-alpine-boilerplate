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
 * @property string|null $categories 카테고리
 * @property int $is_delete 삭제 여부
 * @property string|null $deleted_at 삭제일시
 * @property string $subject 제목
 * @property string $content 내용
 * @property int|null $user_id 작성자 회원 인덱스
 * @property string $writer 작성자
 * @property User|null $answer 답변
 * @property int|null $answer_user_id 답변자 회원 인덱스
 * @property string|null $answer_writer 답변자
 * @property string|null $answered_at 답변일시
 * @property int $status 답변상태 0:미답변, 1:답변완료
 * @property string $ip 작성자 아이피
 * @property-read User|null $user
 * @method static Builder|Inquiry newModelQuery()
 * @method static Builder|Inquiry newQuery()
 * @method static Builder|Inquiry query()
 * @method static Builder|Inquiry whereAnswer($value)
 * @method static Builder|Inquiry whereAnswerUserId($value)
 * @method static Builder|Inquiry whereAnswerWriter($value)
 * @method static Builder|Inquiry whereAnsweredAt($value)
 * @method static Builder|Inquiry whereCategories($value)
 * @method static Builder|Inquiry whereContent($value)
 * @method static Builder|Inquiry whereCreatedAt($value)
 * @method static Builder|Inquiry whereDeletedAt($value)
 * @method static Builder|Inquiry whereId($value)
 * @method static Builder|Inquiry whereIp($value)
 * @method static Builder|Inquiry whereIsDelete($value)
 * @method static Builder|Inquiry whereStatus($value)
 * @method static Builder|Inquiry whereSubject($value)
 * @method static Builder|Inquiry whereUpdatedAt($value)
 * @method static Builder|Inquiry whereUserId($value)
 * @method static Builder|Inquiry whereWriter($value)
 * @mixin Eloquent
 */
class Inquiry extends Model
{
    protected $fillable = [
        'categories',
        'subject',
        'content',
        'user_id',
        'writer',
        'ip',
        'answer_content',
        'answer_user_id',
        'answer_writer',
        'answer_at',
    ];

    protected $guarded = [
        'hit',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'answer_user_id', 'id');
    }
}
