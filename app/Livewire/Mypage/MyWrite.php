<?php

namespace App\Livewire\Mypage;

use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MyWrite extends Component
{
    use BoardConfig;
    use WithPagination;

    public $classify='write', $searchString, $pageRows, $page;

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-write', [
            'writeList' => $this->listWrites(),
        ]);
    }

    public function listWrites(): LengthAwarePaginator
    {
        $query = BoardWrite::where('is_delete', 0)->where('user_id', auth()->id());

        if (!empty($this->searchString)) {
            $query->where(function ($query) {
                $query->where('subject', 'like', '%'.$this->searchString.'%')
                    ->orWhere('content', 'like', '%'.$this->searchString.'%');
            });
        }

        if (empty($this->pageRows)) $this->pageRows = 15;

        return $query->orderBy('id', 'desc')->paginate($this->pageRows);
    }

    public function updatedClassify(): void
    {
        $this->redirectRoute('mypage.' . $this->classify . '.list', navigate: true);
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchString', 'pageRows', 'classify'])) {
            $this->resetPage();
        }
    }

    public function updatedPage($page): void
    {
        $this->page = $page;
    }
}
