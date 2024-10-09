<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\PointService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => ['required', 'email', 'unique:users,email'],
            'nickname' => ['required', 'min:2', 'max:8', 'unique:users,nickname'],
            'password' => ['required', 'min:8', 'max:16', 'regex:/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,16}$/'],
            'password_confirm' => ['required', 'same:password'],
            'terms' => ['accepted'],
            'privacy' => ['accepted'],
        ], [
            'email.required' => '이메일을 입력해 주세요.',
            'email.email' => '유효한 이메일 주소를 입력해 주세요.',
            'email.unique' => '이미 사용 중인 이메일입니다.',
            'nickname.required' => '닉네임을 입력해 주세요.',
            'nickname.min' => '닉네임은 최소 2자 이상이어야 합니다.',
            'nickname.max' => '닉네임은 최대 8자까지 입력할 수 있습니다.',
            'nickname.unique' => '이미 사용 중인 닉네임입니다.',
            'password.required' => '비밀번호를 입력해 주세요.',
            'password.min' => '비밀번호는 최소 8자 이상이어야 합니다.',
            'password.max' => '비밀번호는 최대 16자까지 입력할 수 있습니다.',
            'password.regex' => '비밀번호는 대문자와 특수문자가 포함되어야 합니다.',
            'password_confirm.required' => '비밀번호 확인을 입력해 주세요.',
            'password_confirm.same' => '비밀번호 확인이 일치하지 않습니다.',
            'terms.accepted' => '서비스 이용약관에 동의해 주세요.',
            'privacy.accepted' => '개인정보 수집/이용에 동의해 주세요.',
        ])->validate();

        $user = User::create([
            'name' => $input['nickname'],
            'nickname' => $input['nickname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'point' => 1000,
            'social_type' => 'email',
            'last_login_at' => now(),
            'login_ip' => request()->ip(),
        ]);

        $pointService = new PointService();
        if (cache('config.point')->point->use_point_join == '1'){
            $pointService->savePoint('users', $user->id, 'join', $user->id, $user->id);
        }

        return $user;
    }
}
