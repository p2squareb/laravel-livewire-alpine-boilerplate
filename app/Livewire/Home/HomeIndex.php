<?php

namespace App\Livewire\Home;

use App\Models\User;
use App\Models\UserDormant;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomeIndex extends Component
{
    public function mount(): void
    {
        if (auth()->check()) {
            $user = User::find(auth()->id());
            if (auth()->user()->status === 4 && $user->hasVerifiedEmail()) {
                User::where('id', auth()->id())->update([
                    'status' => 1,
                ]);
                UserDormant::where('user_id', auth()->id())->update([
                    'gubun' => 0,
                ]);
            }
        }
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.home.home-index');
    }
}
