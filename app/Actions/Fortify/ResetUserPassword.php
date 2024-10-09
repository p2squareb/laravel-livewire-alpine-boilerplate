<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\ResetsUserPasswords;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input): void
    {
        $user = User::where('email', $input['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => '해당 이메일 주소를 가진 사용자가 없습니다.',
            ]);
        }

        Validator::make($input, [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,16}$/'],
            'password_confirm' => ['required', 'same:password'],
        ], [
            'email.required' => '이메일을 입력해 주세요.',
            'email.email' => '유효한 이메일 주소를 입력해 주세요.',
            'password.required' => '비밀번호를 입력해 주세요.',
            'password.min' => '비밀번호는 최소 8자 이상이어야 합니다.',
            'password.max' => '비밀번호는 최대 16자까지 입력할 수 있습니다.',
            'password.regex' => '비밀번호는 대문자와 특수문자가 포함되어야 합니다.',
            'password_confirm.required' => '비밀번호 확인을 입력해 주세요.',
            'password_confirm.same' => '비밀번호 확인이 일치하지 않습니다.',
        ])->validate();



        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
