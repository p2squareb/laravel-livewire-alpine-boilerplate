<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * 
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $table_id 테이블 아이디
 * @property string $table_name 테이블 이름
 * @property int $status 테이블 사용 여부
 * @property int $use_category 카테고리 사용 여부
 * @property string|null $category_list 카테고리 항목 (ex:k-pop,pop,hiphop)
 * @property int|null $write_level 글쓰기 등급
 * @property int $use_comment 댓글 사용 여부
 * @property int $use_rate 추천 사용 여부
 * @property int $use_report 신고 사용 여부
 * @property string|null $skin 스킨
 * @property int|null $article_count 게시글 수
 * @property int|null $comment_count 댓글 수
 * @method static Builder|Board newModelQuery()
 * @method static Builder|Board newQuery()
 * @method static Builder|Board query()
 * @method static Builder|Board whereArticleCount($value)
 * @method static Builder|Board whereCategoryList($value)
 * @method static Builder|Board whereCommentCount($value)
 * @method static Builder|Board whereCreatedAt($value)
 * @method static Builder|Board whereId($value)
 * @method static Builder|Board whereSkin($value)
 * @method static Builder|Board whereStatus($value)
 * @method static Builder|Board whereTableId($value)
 * @method static Builder|Board whereTableName($value)
 * @method static Builder|Board whereUpdatedAt($value)
 * @method static Builder|Board whereUseCategory($value)
 * @method static Builder|Board whereUseComment($value)
 * @method static Builder|Board whereUseRate($value)
 * @method static Builder|Board whereUseReport($value)
 * @method static Builder|Board whereWriteLevel($value)
 * @mixin Eloquent
 */
class Board extends Model
{
    protected $fillable = [
        'table_id',
        'table_name',
        'is_open',
        'use_category',
        'category_list',
        'write_level',
        'use_comment',
        'use_file_upload',
        'use_like',
        'use_report',
        'skin',
    ];

    protected $hidden = [];

    protected $guarded = [
        'article_count',
        'comment_count',
    ];
}
