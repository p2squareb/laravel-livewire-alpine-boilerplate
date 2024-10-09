<?php

namespace App\Livewire\Layouts\Partials;

use App\Models\Notification;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;

class AppNavbar extends Component
{
    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.layouts.partials.app-navbar', [
            'notifications' => $this->notifications(),
        ]);
    }

    protected function notifications(): array|Collection|\Illuminate\Support\Collection
    {
        return Notification::where('receive_id', auth()->id())->where('is_read', 0)->orderByDesc('id')->get();
    }

    public function markAsRead($id, $type, $link=null): void
    {
        if ($type === 'link') {
            Notification::where('id', $id)->update(['is_read' => 1, 'read_at' => now()]);
            $this->redirect($link, navigate: true);
        }elseif ($type === 'all_read') {
            Notification::where('receive_id', auth()->id())->update(['is_read' => 1, 'read_at' => now()]);
        }elseif ($type === 'all_view') {
            Notification::where('receive_id', auth()->id())->update(['is_read' => 1, 'read_at' => now()]);
            $this->redirectRoute('mypage.notification.list', navigate: true);
        }
    }
}
