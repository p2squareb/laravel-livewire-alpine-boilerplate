<?php

namespace App\Livewire\Board;

use App\Models\BoardRate;
use App\Models\BoardReport;
use App\Models\BoardWrite;
use App\Services\PointService;
use App\Traits\BoardConfig;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WriteRead extends Component
{
    use BoardConfig;

    public $board, $tableId, $writeId, $rateField, $writeReport = null;

    protected $listeners = ['updateWriteReport', 'reRenderParent' => 'reRender'];

    public function mount($tableId, $writeId): void
    {
        $this->tableId = $tableId;
        $this->board = $this->getBoard($tableId);
        $this->writeId = $writeId;

        BoardWrite::where('id', $writeId)->increment('hit');
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view("livewire.board.{$this->board->skin}.write-read", [
            'writeData' => $this->writeData()
        ]);
    }

    public function writeData(): array
    {
        $write = BoardWrite::where('id', $this->writeId)->first();

        $this->rateField = $write->rate_up - $write->rate_down;

        $threeDotView = false;
        if (auth()->check()) {
            if (is_null($write->user_id)) {
                $threeDotView = true;
            }else{
                if (auth()->user()->group_level >= 11 || ($write->user_id === auth()->user()->id)) {
                    $threeDotView = true;
                }
            }
        }else{
            if (is_null($write->user_id)) {
                $threeDotView = true;
            }
        }

        return [
            'write' => $write,
            'threeDotView' => $threeDotView
        ];
    }

    public function updateWriteRate(PointService $pointService, $type): void
    {
        $write = BoardWrite::where('id', $this->writeId)->first();
        if (auth()->id() === $write->user_id){
            $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '본인이 작성한 게시물은 추천이 불가합니다.');
        }else{
            $rate = BoardRate::where('table_id', $this->board->table_id)->where('write_id', $this->writeId)->where('user_id', auth()->user()->id)->first();
            if ($rate) {
                $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '이미 참여하셨습니다.');
            }else{
                BoardRate::insert([
                    'board_id' => $this->board->id,
                    'table_id' => $this->board->table_id,
                    'write_id' => $this->writeId,
                    'user_id' => auth()->user()->id,
                    'rate' => $type,
                    'target_user_id' => BoardWrite::where('id', $this->writeId)->value('user_id'),
                ]);

                if ($type === 'up') {
                    BoardWrite::where('id', $this->writeId)->increment('rate_up');
                    if (cache('config.point')->point->use_point_write_up == '1'){
                        $pointService->savePoint('board_writes', $this->writeId, 'write_up', $write->user_id, auth()->id());
                    }
                }else{
                    BoardWrite::where('id', $this->writeId)->increment('rate_down');
                    if (cache('config.point')->point->use_point_write_down == '1'){
                        $pointService->savePoint('board_writes', $this->writeId, 'write_down', $write->user_id, auth()->id());
                    }
                }

                $write = BoardWrite::where('id', $this->writeId)->first();
                $this->rateField = $write->rate_up - $write->rate_down;
            }
        }
    }

    public function updateWriteReport(): void
    {
        $write = BoardWrite::where('id', $this->writeId)->first();
        if (auth()->id() === $write->user_id){
            $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '본인이 작성한 게시물은 신고가 불가합니다.');
        }else{
            $report = BoardReport::where('table_id', $this->board->table_id)->where('write_id', $this->writeId)->where('user_id', auth()->user()->id)->exists();

            if ($report) {
                $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '이미 신고한 게시물입니다.');
            }else{
                BoardReport::insert([
                    'board_id' => $this->board->id,
                    'table_id' => $this->board->table_id,
                    'write_id' => $this->writeId,
                    'user_id' => auth()->user()->id,
                    'field' => $this->writeReport,
                    'target_user_id' => BoardWrite::where('id', $this->writeId)->value('user_id'),
                    'title' => $write->subject,
                ]);
                $this->dispatch('open-alert', type: 'success', next: 'close', link: '', message: '신고가 접수되었습니다.');
            }
        }
    }

    public function reRender(): void
    {
        $this->render();
    }
}
