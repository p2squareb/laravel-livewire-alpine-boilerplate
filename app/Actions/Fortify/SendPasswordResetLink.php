<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Laravel\Fortify\Contracts\SuccessfulPasswordResetLinkRequestResponse;
use Laravel\Fortify\Contracts\FailedPasswordResetLinkRequestResponse;
use Laravel\Fortify\Fortify;

class SendPasswordResetLink
{
    public function send(Request $request): Responsable
    {
        $request->validate([Fortify::email() => 'required|email'], [
            'email.required' => '이메일을 입력해 주세요.',
            'email.email' => '올바른 이메일 형식을 입력해 주세요.',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? app(SuccessfulPasswordResetLinkRequestResponse::class, ['status' => $status])
            : app(FailedPasswordResetLinkRequestResponse::class, ['status' => $status]);
    }
}
