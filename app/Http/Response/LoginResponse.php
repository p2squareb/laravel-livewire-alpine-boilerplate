<?php

namespace App\Http\Response;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request): JsonResponse|RedirectResponse|Response
    {
        User::where('id', auth()->id())->update([
            'last_login_at' => now(),
            'login_ip' => $request->ip(),
        ]);

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($request->session()->get('login.url.intended', '/'));
    }

}
