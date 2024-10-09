<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

/**
 * 
 *
 * @property int $id
 * @property string|null $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $status 1:정상, 2:탈퇴, 3:정지, 4:휴면
 * @property string|null $name 이름
 * @property string $nickname 닉네임
 * @property string $email 이메일
 * @property Carbon|null $email_verified_at
 * @property mixed|null $password 비밀번호
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property int $group_level 그룹 레벨
 * @property string|null $cellphone 휴대폰 번호
 * @property int $point 포인트
 * @property string|null $zipcode 우편번호
 * @property string|null $addr1 주소
 * @property string|null $addr2 상세 주소
 * @property string|null $social_type SNS 로그인
 * @property string|null $last_login_at 최근 로그인 시간
 * @property string|null $login_ip 로그인 아이피
 * @property string|null $leaved_at 탈퇴 날짜
 * @property string $mailing_yn 메일 수신 여부
 * @property string $sms_yn SMS 수신 여부
 * @property string|null $profile_photo_path 프로필 이미지
 * @property-read Collection<int, BoardComment> $comments
 * @property-read int|null $comments_count
 * @property-read UserGroup|null $group
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read string $profile_photo_url
 * @property-read Collection<int, PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereAddr1($value)
 * @method static Builder|User whereAddr2($value)
 * @method static Builder|User whereCellphone($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereGroupLevel($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastLoginAt($value)
 * @method static Builder|User whereLeaveCause($value)
 * @method static Builder|User whereLeavedAt($value)
 * @method static Builder|User whereLoginIp($value)
 * @method static Builder|User whereMailingYn($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNickname($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePoint($value)
 * @method static Builder|User whereProfilePhotoPath($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereSmsYn($value)
 * @method static Builder|User whereSocialType($value)
 * @method static Builder|User whereStatus($value)
 * @method static Builder|User whereTwoFactorConfirmedAt($value)
 * @method static Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static Builder|User whereTwoFactorSecret($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static Builder|User whereZipcode($value)
 * @property string|null $leave_cause 탈퇴 사유
 * @mixin Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
        'social_type',
        'last_login_at',
        'login_ip',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class, 'group_level', 'level');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(BoardComment::class, 'user_id', 'id');
    }
}
