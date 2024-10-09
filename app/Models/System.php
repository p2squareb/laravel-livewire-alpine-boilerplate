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
 * @property string|null $register_ip 등록자 ip
 * @property string|null $register_id 등록자 아이디
 * @property string|null $title 설정 제목
 * @property string|null $content 설정 내용
 * @method static Builder|System newModelQuery()
 * @method static Builder|System newQuery()
 * @method static Builder|System query()
 * @method static Builder|System whereContent($value)
 * @method static Builder|System whereCreatedAt($value)
 * @method static Builder|System whereId($value)
 * @method static Builder|System whereRegisterId($value)
 * @method static Builder|System whereRegisterIp($value)
 * @method static Builder|System whereTitle($value)
 * @mixin Eloquent
 */
class System extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'register_ip',
        'register_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
