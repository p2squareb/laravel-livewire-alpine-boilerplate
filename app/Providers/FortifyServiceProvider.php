<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use App\Models\Point;
use App\Models\UserProhibit;
use App\Services\PointService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::loginView(function (Request $request) {
            $request->session()->put('login.url.intended', url()->previous());
            return view('auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ], [
                'email.required' => '이메일을 입력해 주세요.',
                'email.email' => '올바른 이메일 형식을 입력해 주세요.',
                'password.required' => '비밀번호를 입력해 주세요.',
            ]);

            $user = User::where('email', $request->email)->whereIn('status', [1,3,4])->first();

            if ($user->status === 3){
                $prohibit = UserProhibit::where('user_id', $user->id)->where('gubun', 1)->orderBy('id', 'desc')->first();
                if ($prohibit){
                    throw ValidationException::withMessages([
                        'auth-failed' => '이용 수칙에 어긋나 계정이 정지되었습니다. 해지일 : ' . $prohibit->until_date,
                    ]);
                }
            }elseif ($user->status === 4){
                $request->session()->put('login.url.intended', '/email/verify');
            }

            if ($user && Hash::check($request->password, $user->password)) {
                $point_exsist = Point::where('to_user_id', $user->id)->where('point_item', 'login')->exists();
                if (cache('config.point')->point->use_point_login == '1' && !$point_exsist){
                    $pointService = new PointService();
                    $pointService->savePoint('users', $user->id, 'login', $user->id, $user->id);
                }
                return $user;
            }

            throw ValidationException::withMessages([
                'auth-failed' => '이메일 또는 비밀번호가 올바르지 않습니다.',
            ]);
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
