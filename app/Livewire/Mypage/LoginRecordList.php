<?php

namespace App\Livewire\Mypage;

use App\Models\LoginRecord;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class LoginRecordList extends Component
{
    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.login-record-list', [
            'loginRecordList' => $this->listLoginRecords(),
        ]);
    }

    public function listLoginRecords(): array|Collection|\Illuminate\Support\Collection
    {
        return LoginRecord::where('user_id', auth()->id())->orderBy('id', 'desc')->limit(30)->get();
    }
}
