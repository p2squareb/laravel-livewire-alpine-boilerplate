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
 * @property int $user_id
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property string|null $social_type
 * @property string $login_at
 * @method static Builder|LoginRecord newModelQuery()
 * @method static Builder|LoginRecord newQuery()
 * @method static Builder|LoginRecord query()
 * @method static Builder|LoginRecord whereCreatedAt($value)
 * @method static Builder|LoginRecord whereId($value)
 * @method static Builder|LoginRecord whereIpAddress($value)
 * @method static Builder|LoginRecord whereLoginAt($value)
 * @method static Builder|LoginRecord whereSocialType($value)
 * @method static Builder|LoginRecord whereUpdatedAt($value)
 * @method static Builder|LoginRecord whereUserAgent($value)
 * @method static Builder|LoginRecord whereUserId($value)
 * @mixin Eloquent
 */
class LoginRecord extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'login_at',
    ];
}
