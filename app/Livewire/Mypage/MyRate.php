<?php

namespace App\Livewire\Mypage;

use App\Models\BoardComment;
use App\Models\BoardRate;
use App\Models\BoardWrite;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MyRate extends Component
{
    use WithPagination;

    public $classify='rate';

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-rate', [
            'rateList' => $this->listRates(),
        ]);
    }

    public function listRates(): LengthAwarePaginator
    {
        $rates = BoardRate::where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(50);
        foreach($rates as $rate) {
            if (!is_null($rate->write_id)){
                $write = BoardWrite::selectRaw('id, is_delete, subject')->where('id', $rate->write_id)->first();
                $rate->gubun = '게시글';
                $rate->title = $write->subject;
                $rate->is_delete = $write->is_delete;
                $rate->target_id = $write->id;
            }elseif (!is_null($rate->comment_id)){
                $comment = BoardComment::selectRaw('write_id, is_delete, comment')->where('id', $rate->comment_id)->first();
                $rate->gubun = '댓글';
                $rate->title = $comment->comment;
                $rate->is_delete = $comment->is_delete;
                $rate->target_id = $comment->write_id;
            }
        }
        return $rates;
    }

    public function updatedClassify(): void
    {
        $this->redirectRoute('mypage.' . $this->classify . '.list', navigate: true);
    }
}
