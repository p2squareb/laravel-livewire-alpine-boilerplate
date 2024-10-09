<?php

namespace App\Livewire\Mypage;

use App\Models\BoardComment;
use App\Models\BoardReport;
use App\Models\BoardWrite;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MyReport extends Component
{
    use WithPagination;

    public $classify='report';

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-report', [
            'reportList' => $this->listReports(),
        ]);
    }

    public function listReports(): LengthAwarePaginator
    {
        $reports = BoardReport::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(50);
        foreach($reports as $report) {
            if (!is_null($report->write_id)){
                $write = BoardWrite::where('id', $report->write_id)->first();
                $report->is_delete = $write->is_delete;
                $report->profile_photo_path = $write->user->profile_photo_path;
                $report->writer = $write->writer;
            }elseif (!is_null($report->comment_id)){
                $comment = BoardComment::where('id', $report->comment_id)->first();
                $report->is_delete = $comment->is_delete;
                $report->profile_photo_path = $comment->user->profile_photo_path;
                $report->writer = $comment->writer;
            }
        }
        return $reports;
    }

    public function updatedClassify(): void
    {
        $this->redirectRoute('mypage.' . $this->classify . '.list', navigate: true);
    }
}
