<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });

        $this->app->instance(
            \Laravel\Fortify\Contracts\RegisterResponse::class,
            new class implements \Laravel\Fortify\Contracts\RegisterResponse {
                public function toResponse($request)
                {
                    Auth::logout();
                    return redirect('/email/verify');
                }
            }
        );

        $this->app->instance(
            \Laravel\Fortify\Contracts\VerifyEmailViewResponse::class,
            new class implements \Laravel\Fortify\Contracts\VerifyEmailViewResponse {
                public function  toResponse($request): RedirectResponse
                {
                    return redirect()->intended('/mypage/profile');
                }
            }
        );

        fortify::loginView(function () {
            return view('auth.login');
        });

        $this->app->instance(LoginRequest::class, new LoginRequest());

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });

        $this->app->singleton(
            RegisterResponseContract::class,
            RegisterResponse::class
        );
    }
}
