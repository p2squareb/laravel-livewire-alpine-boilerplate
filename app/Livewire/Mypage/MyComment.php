<?php

namespace App\Livewire\Mypage;

use App\Models\BoardComment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MyComment extends Component
{
    use WithPagination;

    public $classify='comment', $searchString, $pageRows, $page;

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-comment', [
            'commentList' => $this->listComments(),
        ]);
    }

    public function listComments(): LengthAwarePaginator
    {
        $query = BoardComment::where('is_delete', 0)->where('user_id', auth()->id());

        if (!empty($this->searchString)) {
            $query->where(function ($query) {
                $query->where('comment', 'like', '%'.$this->searchString.'%');
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
