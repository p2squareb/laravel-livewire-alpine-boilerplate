<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;
use App\Models\LoginRecord;

class LogLoginRecord
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;

        if (!empty($user->id)) {
            LoginRecord::create([
                'user_id' => $user->id,
                'ip_address' => Request::ip(),
                'user_agent' => Request::header('User-Agent'),
                'login_at' => now(),
            ]);
        }
    }
}
