<?php

namespace App\Livewire\Admin\Board;

use App\Models\Board;
use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class BoardWriteList extends Component
{
    use Toastable;
    use BoardConfig;
    use WithPagination;

    public $boardList, $boardId, $pageRows, $deleteStatus='', $searchKind='', $searchString;
    public $page, $deleteRowId = null, $removeRowId = null;

    protected $listeners = ['deleteRow' => 'updateDeleteStatus', 'removeRow' => 'removeWrite'];

    public function mount(): void
    {
        $this->boardList = Board::where('status', 1)->get();
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.board.board-write-list', [
            'writes' => $this->writes(),
        ]);
    }

    public function writes(): LengthAwarePaginator
    {
        $query = BoardWrite::query();

        if (!empty($this->searchString)) {
            if (!empty($this->searchKind)) {
                $query->where($this->searchKind, 'like', '%'.$this->searchString.'%');
            } else {
                $query->where(function ($query) {
                    $query->where('subject', 'like', '%'.$this->searchString.'%')
                        ->orWhere('content', 'like', '%'.$this->searchString.'%');
                });
            }
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
            BoardWrite::where('id', $this->deleteRowId)->update([
                'is_delete' => 1,
                'deleted_at' => Carbon::now()
            ]);
            $this->deleteRowId = null;
            $this->dispatch('close-confirm');
            $this->toastSuccess('정상적으로 삭제 처리되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardWriteList.updateDeleteStatus : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function restoreWrite($target_id): void
    {
        try{
            BoardWrite::where('id', $target_id)->update([
                'is_delete' => 0,
                'deleted_at' => null
            ]);
            $this->toastSuccess('정상적으로 복구 처리되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardWriteList.restoreWrite : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function removeWrite(): void
    {
        $write = BoardWrite::where('id', $this->removeRowId)->first();
        try{
            $imagePaths = getImagePaths($write->content);
            foreach ($imagePaths as $path) {
                $filePath = storage_path('app/public/'. $path);
                if (File::exists($filePath)){
                    File::delete($filePath);
                }
            }

            BoardWrite::where('id', $this->removeRowId)->delete();
            $this->updateArticleCount($write->table_id, 'delete');

            $this->removeRowId = null;
            $this->dispatch('close-confirm');
            $this->toastSuccess('정상적으로 삭제되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardWriteList.restoreWrite : ' . $e->getMessage());
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
