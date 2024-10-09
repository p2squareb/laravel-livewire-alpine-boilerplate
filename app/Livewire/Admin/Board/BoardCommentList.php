<?php

namespace App\Livewire\Admin\Board;

use App\Models\Board;
use App\Models\BoardComment;
use App\Traits\BoardConfig;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BoardCommentList extends Component
{
    use Toastable;
    use BoardConfig;
    use WithPagination;

    public $boardList, $boardId, $pageRows, $deleteStatus='', $searchKind='comment', $searchString;
    public $page, $deleteRowId = null, $removeRowId = null;

    protected $listeners = ['deleteRow' => 'updateDeleteStatus', 'removeRow' => 'removeWrite'];

    public function mount(): void
    {
        $this->boardList = Board::where('status', 1)->get();
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.board.board-comment-list', [
            'comments' => $this->comments(),
        ]);
    }

    public function comments(): LengthAwarePaginator
    {
        $query = BoardComment::query();

        if (!empty($this->searchString)) {
            $query->where($this->searchKind, 'like', '%'.$this->searchString.'%');
        }

        if (!empty($this->boardId)) {
            $query->where('board_id', $this->boardId);
        }

        if ($this->deleteStatus !== '') {
            $query->where('is_delete', $this->deleteStatus);
        }

        if (empty($this->pageRows)) $this->pageRows = 15;

        return $query->orderBy('id', 'desc')->paginate($this->pageRows);
    }

    public function updateDeleteStatus(): void
    {
        try{
            BoardComment::where('id', $this->deleteRowId)->update([
                'is_delete' => 1,
                'deleted_at' => Carbon::now()
            ]);
            $this->deleteRowId = null;
            $this->dispatch('close-confirm');
            $this->toastSuccess('정상적으로 삭제 처리되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardCommentList.updateDeleteStatus : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function restoreWrite($target_id): void
    {
        try{
            BoardComment::where('id', $target_id)->update([
                'is_delete' => 0,
                'deleted_at' => null
            ]);
            $this->toastSuccess('정상적으로 복구 처리되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardCommentList.restoreWrite : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function removeWrite(): void
    {
        $comment = BoardComment::where('id', $this->removeRowId)->first();
        try{
            BoardComment::where('id', $this->removeRowId)->delete();
            $this->updateCommentCount($comment->table_id, $comment->write_id, 'delete');

            $this->removeRowId = null;
            $this->dispatch('close-confirm');
            $this->toastSuccess('정상적으로 삭제되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardCommentList.restoreWrite : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['boardId', 'pageRows', 'deleteStatus', 'searchKind', 'searchString'])) {
            $this->resetPage();
        }
    }

    public function updatedPage($page): void
    {
        $this->page = $page;
    }
}
