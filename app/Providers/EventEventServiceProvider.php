<?php

namespace App\Providers;

use App\Listeners\LogLoginRecord;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;

class EventEventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    protected array $listen = [
        Login::class => [
            LogLoginRecord::class,
        ],
    ];
}
