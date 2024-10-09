<?php

namespace App\Livewire\Mypage;

use App\Models\Point;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MyPoint extends Component
{
    use WithPagination;

    public $classify='point', $pageRows = 15;

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-point', [
            'points' => $this->points(),
        ]);
    }

    public function points(): LengthAwarePaginator
    {
        $query = Point::where('to_user_id', auth()->id());
        return $query->orderBy('id', 'desc')->paginate($this->pageRows)->onEachSide(2);
    }

    public function updatedClassify(): void
    {
        $this->redirectRoute('mypage.' . $this->classify . '.list', navigate: true);
    }
}
