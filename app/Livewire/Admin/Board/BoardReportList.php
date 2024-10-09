<?php

namespace App\Livewire\Admin\Board;

use App\Models\Board;
use App\Models\BoardComment;
use App\Models\BoardReport;
use App\Models\BoardWrite;
use App\Services\NotificationService;
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

class BoardReportList extends Component
{
    use Toastable;
    use BoardConfig;
    use WithPagination;

    public $boardList, $boardId, $pageRows = 15, $reportStatus='', $searchKind='title', $searchString;
    public $deleteRowId = null, $removeRowId = null, $returnBackRowId = null;

    protected $listeners = ['deleteRow' => 'updateDeleteStatus', 'removeRow' => 'removeReport', 'returnBackRow' => 'returnBackReport'];

    public function mount(): void
    {
        $this->boardList = Board::where('status', 1)->get();
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.board.board-report-list', [
            'reports' => $this->reports()
        ]);
    }

    public function reports(): LengthAwarePaginator
    {
        $query = BoardReport::with('user')->with('target');

        if (!empty($this->boardId)) {
            $query->where('board_id', $this->boardId);
        }

        if ($this->reportStatus !== '') {
            $query->where('status', $this->reportStatus);
        }

        if (!empty($this->searchString)) {
            if ($this->searchKind === 'title') {
                $query->where('title', 'like', '%'.$this->searchString.'%');
            }elseif ($this->searchKind === 'reporter') {
                $query->whereHas('user', function ($query) {
                    $query->where('nickname', 'like', '%'. $this->searchString. '%');
                });
            }elseif ($this->searchKind === 'writer') {
                $query->whereHas('target', function ($query) {
                    $query->where('nickname', 'like', '%'. $this->searchString. '%');
                });
            }
        }

        $reports = $query->orderBy('id', 'desc')->paginate($this->pageRows);

        foreach($reports as $report) {
            if (is_null($report->comment_id)){
                $write = BoardWrite::where('id', $report->write_id)->first();
                $report->is_delete = $write->is_delete;
            }else{
                $comment = BoardComment::where('id', $report->comment_id)->first();
                $report->is_delete = $comment->is_delete;
            }
        }

        return $reports;
    }

    public function updateDeleteStatus(): void
    {
        $report = BoardReport::find($this->deleteRowId);

        try{
            if (is_null($report->comment_id)) {
                BoardWrite::where('id', $report->write_id)->update([
                    'is_delete' => 1,
                    'deleted_at' => Carbon::now()
                ]);
            }else{
                BoardComment::where('id', $report->comment_id)->update([
                    'is_delete' => 1,
                    'deleted_at' => Carbon::now()
                ]);
            }
            $this->deleteRowId = null;
            BoardReport::where('id', $report->id)->update(['status' => 1]);

            $notificationService = new NotificationService();
            $notificationService->saveNotification('updateDeleteStatusA', $report->id);
            $notificationService->saveNotification('updateDeleteStatusB', $report->id);

            $this->dispatch('close-confirm');
            $this->toastSuccess('정상적으로 삭제 처리되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardReportList.updateDeleteStatus : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function returnBackReport(): void
    {
        try{
            BoardReport::where('id', $this->returnBackRowId)->update(['status' => 1]);

            $notificationService = new NotificationService();
            $notificationService->saveNotification('returnBackReport', $this->returnBackRowId);

            $this->returnBackRowId = null;
            $this->dispatch('close-confirm');
            $this->toastSuccess('정상적으로 반려 처리되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardReportList.returnBackReport : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function restoreWrite($target_id): void
    {
        $report = BoardReport::find($target_id);
        try{
            if (!is_null($report->write_id)) {
                BoardWrite::where('id', $report->write_id)->update([
                    'is_delete' => 0,
                    'deleted_at' => null
                ]);
            }elseif (!is_null($report->comment_id)) {
                BoardComment::where('id', $report->comment_id)->update([
                    'is_delete' => 0,
                    'deleted_at' => null
                ]);
            }
            $this->toastSuccess('정상적으로 복구 처리되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardWriteList.restoreWrite : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function removeReport(): void
    {
        $report = BoardReport::find($this->removeRowId);
        try{
            if (!is_null($report->write_id)) {
                BoardReport::where('write_id', $report->write_id)->delete();
                BoardWrite::where('id', $report->write_id)->update(['is_reported' => 0]);
            }elseif (!is_null($report->comment_id)) {
                BoardReport::where('comment_id', $report->comment_id)->delete();
                BoardComment::where('id', $report->comment_id)->update(['is_reported' => 0]);
            }
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
        if (in_array($propertyName, ['boardId', 'pageRows', 'reportStatus', 'searchKind', 'searchString'])) {
            $this->resetPage();
        }
    }
}
