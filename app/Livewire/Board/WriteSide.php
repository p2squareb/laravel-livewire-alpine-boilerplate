<?php

namespace App\Livewire\Board;

use App\Models\BoardWrite;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Component;

class WriteSide extends Component
{
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.board.write-side', [
            'latestWrites' => $this->latestWrites(),
        ]);
    }

    public function latestWrites(): array|Collection|\Illuminate\Support\Collection
    {
        return BoardWrite::where('is_notice', 0)->where('is_delete', 0)->orderByDesc('id')->limit(5)->get();
    }
}
