<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'nickname' => ['required', 'string', 'min:2', 'max:8', Rule::unique('users')->ignore($user->id)],
        ], [
            'nickname.required' => '닉네임을 입력해 주세요.',
            'nickname.string' => '닉네임은 문자열이어야 합니다.',
            'nickname.min' => '닉네임은 최소 2자 이상이어야 합니다.',
            'nickname.max' => '닉네임은 최대 8자 이하이어야 합니다.',
            'nickname.unique' => '이 닉네임은 이미 사용 중입니다.',
        ])->validateWithBag('updateProfileInformation');

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'nickname' => $input['nickname'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'nickname' => $input['nickname'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
