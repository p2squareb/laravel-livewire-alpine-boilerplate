<?php

namespace App\Livewire\Admin\Board;

use App\Models\Board;
use App\Traits\Toastable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BoardList extends Component
{
    use Toastable;
    use WithPagination;

    public $pageRows = 100;
    public $deleteRowId = null;
    public Board $updateSelectedBoard;

    protected $listeners = ['deleteRow' => 'deleteBoard', 'reRenderParentPage'];

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.board.board-list');
    }

    #[Computed]
    protected function boards(): LengthAwarePaginator
    {
        $query = Board::query();
        return $query->orderBy('id', 'desc')->paginate($this->pageRows)->onEachSide(2);
    }
}
