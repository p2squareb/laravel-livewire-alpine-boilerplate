<?php

namespace App\Livewire\Admin\User;

use App\Models\Inquiry;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserInquiry extends Component
{
    public $userId;

    public function mount($userId): void
    {
        $this->userId = $userId;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-inquiry', [
            'inquiries' => $this->inquiries(),
        ]);
    }

    public function inquiries(): array|Collection|\Illuminate\Support\Collection
    {
        $query = Inquiry::where('user_id', $this->userId);
        return $query->orderBy('id', 'desc')->limit(15)->get();
    }
}
