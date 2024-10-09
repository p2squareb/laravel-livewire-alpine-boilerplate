<?php

namespace App\Livewire\Mypage;

use App\Models\Notification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MyNotification extends Component
{
    use WithPagination;

    public $classify='notification', $pageRows = 15;

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-notification', [
            'notifications' => $this->notifications(),
        ]);
    }

    public function notifications(): LengthAwarePaginator
    {
        return Notification::where('receive_id', auth()->id())->orderByDesc('id')->paginate($this->pageRows)->onEachSide(2);
    }

    public function updatedClassify(): void
    {
        $this->redirectRoute('mypage.' . $this->classify . '.list', navigate: true);
    }
}
