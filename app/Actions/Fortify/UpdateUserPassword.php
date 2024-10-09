<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
     /*   Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ])->validateWithBag('updatePassword');*/

        Validator::make($input, [
            'current_password' => ['required', 'current_password:web'],
            'password' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,16}$/'],
            'password_confirmation' => ['required', 'same:password'],
        ], [
            'current_password.required' => '현재 비밀번호를 입력해 주세요.',
            'current_password.current_password' => '현재 비밀번호가 일치하지 않습니다.',
            'password.required' => '비밀번호를 입력해 주세요.',
            'password.min' => '비밀번호는 최소 8자 이상이어야 합니다.',
            'password.max' => '비밀번호는 최대 16자까지 입력할 수 있습니다.',
            'password.regex' => '비밀번호는 대문자와 특수문자가 포함되어야 합니다.',
            'password_confirmation.required' => '비밀번호 확인을 입력해 주세요.',
            'password_confirmation.same' => '비밀번호 확인이 일치하지 않습니다.',
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
