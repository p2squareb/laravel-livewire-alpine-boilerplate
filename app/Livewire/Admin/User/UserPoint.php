<?php

namespace App\Livewire\Admin\User;

use App\Models\Point;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserPoint extends Component
{
    public $userId;

    public function mount($userId): void
    {
        $this->userId = $userId;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-point', [
            'points' => $this->points(),
        ]);
    }

    public function points(): array|\Illuminate\Database\Eloquent\Collection|Collection
    {
        $query = Point::where('to_user_id', $this->userId);
        return $query->orderBy('id', 'desc')->limit(15)->get();
    }
}
