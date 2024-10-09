<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserDormant;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dormant-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'dormant users scheduled job';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        if (cache('config.basic')->basic->use_dormant == '0'){
            return;
        }

        $oneYearAgo = Carbon::now()->subYear();

        $users = User::where('last_login_at', '<', $oneYearAgo)->where('status', 1)->get();
        foreach($users as $user){
            User::where('id', $user->id)->update([
                'email_verified_at' => null,
                'status' => 4,
            ]);

            UserDormant::create([
                'user_id' => $user->id,
                'gubun' => 1,
            ]);
        }

        $this->info('Inactive users have been updated successfully.');
    }
}
