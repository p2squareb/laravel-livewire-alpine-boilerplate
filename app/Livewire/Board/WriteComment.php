<?php

namespace App\Livewire\Board;

use App\Models\BoardComment;
use App\Models\BoardRate;
use App\Models\BoardReport;
use App\Models\BoardWrite;
use App\Services\NotificationService;
use App\Services\PointService;
use App\Traits\BoardConfig;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class WriteComment extends Component
{
    use BoardConfig;
    use WithPagination;

    public $board;
    public $writeId;
    public $perPage = 30;
    public $commentReport = null;
    public $comment, $editComment, $replyComment;
    public $updateCommentId, $deleteCommentId, $reportCommentId, $rateCommentId;
    public $showReplyTextarea = [];

    protected $listeners = ['deleteComment', 'updateCommentReport'];

    public function mount($board, $writeId): void
    {
        $this->board = $board;
        $this->writeId = $writeId;

        $comments = BoardComment::all();
        foreach ($comments as $comment) {
            $this->showReplyTextarea[$comment->id] = false;
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view("livewire.board.write-comment", [
            'commentData' => $this->getComments()
        ]);
    }

    public function getComments(): LengthAwarePaginator
    {
        return BoardComment::where('table_id', $this->board->table_id)->where('write_id', $this->writeId)
            ->orderBy('parent_id')->orderBy('depth')->paginate($this->perPage);
    }

    public function moreComment(): void
    {
        $this->perPage += 30;
    }

    public function createComment(PointService $pointService, NotificationService $notificationService): void
    {
        $this->validate([
            'comment' => 'required',
        ], [
            'comment.required' => '댓글 내용을 입력해주세요.'
        ]);

        $write = BoardWrite::select('user_id')->where('id', $this->writeId)->first();

        try {
            $lastCommentInsertId = BoardComment::insertGetId([
                'board_id' => $this->board->id,
                'table_id' => $this->board->table_id,
                'write_id' => $this->writeId,
                'depth' => 0,
                'user_id' => auth()->user()->id,
                'writer' => auth()->user()->nickname,
                'comment' => $this->comment,
                'ip' => request()->ip()
            ]);

            BoardComment::where('id', $lastCommentInsertId)->update([
               'parent_id' => $lastCommentInsertId,
            ]);
            $this->updateCommentCount($this->board->table_id, $this->writeId, 'create');

            if (cache('config.point')->point->use_point_comment == '1'){
                $pointService->savePoint('board_comments', $lastCommentInsertId, 'comment', auth()->id(), auth()->id());
            }
            if (cache('config.point')->point->use_point_write_comment == '1'){
                if ($write->user_id !== auth()->id()){
                    $pointService->savePoint('board_writes', $this->writeId, 'write_comment', $write->user_id, auth()->id());
                }
            }

            if (auth()->id() !== $write->user_id) {
                $notificationService->saveNotification('createComment', $this->writeId, $lastCommentInsertId);
            }

            $this->reset(['comment']);
            $this->dispatch('close-modal');
            $this->dispatch('reRenderParent');
        }catch (Exception $e) {
            Debugbar::error($e);
            $this->dispatch('open-alert', type: 'error', next: '', link: '', message: '');
        }
    }

    public function createReplyComment($replyCommentId): void
    {
        $this->validate([
            'replyComment' => 'required',
        ], [
            'replyComment.required' => '답변 내용을 입력해주세요.'
        ]);

        $comment = BoardComment::where('id', $replyCommentId)->first();

        $lastCommentInsertId = BoardComment::insertGetId([
            'board_id' => $this->board->id,
            'table_id' => $this->board->table_id,
            'write_id' => $this->writeId,
            'parent_id' => $comment->id,
            'depth' => $comment->depth + 1,
            'user_id' => auth()->user()->id,
            'writer' => auth()->user()->nickname,
            'comment' => $this->replyComment,
            'ip' => request()->ip()
        ]);

        $this->updateCommentCount($this->board->table_id, $this->writeId, 'create');

        if (auth()->id() !== $comment->user_id) {
            $notificationService = new NotificationService();
            $notificationService->saveNotification('createReplyComment', $replyCommentId, $lastCommentInsertId);
        }

        $this->reset(['replyComment']);
        $this->dispatch('reRenderParent');
        $comments = BoardComment::all();
        foreach ($comments as $comment) {
            $this->showReplyTextarea[$comment->id] = false;
        }
    }

    public function updateModal($updateCommentId): void
    {
        $this->updateCommentId = $updateCommentId;
        $comment = BoardComment::select('comment')->where('id', $updateCommentId)->first();
        $this->editComment = $comment->comment;
    }

    public function updateComment(): void
    {
        $this->validate([
            'editComment' => 'required',
        ], [
            'editComment.required' => '댓글 내용을 입력해주세요.'
        ]);

        try {
            BoardComment::where('id', $this->updateCommentId)->update([
                'comment' => $this->editComment,
                'ip' => request()->ip()
            ]);

            $this->reset(['editComment', 'updateCommentId']);
            $this->dispatch('close-modal');
            $this->dispatch('reRenderParent');
        }catch (Exception $e) {
            Debugbar::error($e);
            $this->dispatch('open-alert', type: 'error', next: '', link: '', message: '');
        }
    }

    public function deleteComment(): void
    {
        try{
            $comment = BoardComment::where('id', $this->deleteCommentId)->where('user_id', auth()->user()->id)->first();
            if ($comment){
                BoardComment::where('id', $this->deleteCommentId)->update([
                    'is_delete' => 1,
                    'deleted_at' => Carbon::now()
                ]);
            }
        }catch (Exception $e) {
            Debugbar::error($e);
            $this->dispatch('open-alert', type: 'error', next: '', link: '', message: '');
        }
    }

    public function updateCommentRate(PointService $pointService, $type): void
    {
        $comment = BoardComment::where('id', $this->rateCommentId)->first();
        if (auth()->id() === $comment->user_id){
            $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '본인이 작성한 댓글은 추천이 불가합니다.');
        }else{
            $rate = BoardRate::where('table_id', $this->board->table_id)->where('comment_id', $this->rateCommentId)->where('user_id', auth()->user()->id)->first();
            if ($rate) {
                $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '이미 참여하셨습니다.');
            }else{
                BoardRate::insert([
                    'board_id' => $this->board->id,
                    'table_id' => $this->board->table_id,
                    'comment_id' => $this->rateCommentId,
                    'user_id' => auth()->user()->id,
                    'rate' => $type,
                    'target_user_id' => $comment->user_id,
                ]);

                if ($type === 'up') {
                    BoardComment::where('id', $this->rateCommentId)->increment('rate_up');
                    if (cache('config.point')->point->use_point_comment_up == '1'){
                        $pointService->savePoint('board_comments', $this->rateCommentId, 'comment_up', $comment->user_id, auth()->id());
                    }
                }else{
                    BoardComment::where('id', $this->rateCommentId)->increment('rate_down');
                    if (cache('config.point')->point->use_point_comment_down == '1'){
                        $pointService->savePoint('board_comments', $this->rateCommentId, 'comment_down', $comment->user_id, auth()->id());
                    }
                }
            }
        }
    }

    public function updateCommentReport(): void
    {
        $comment = BoardComment::where('id', $this->reportCommentId)->first();
        if (auth()->id() === $comment->user_id){
            $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '본인이 작성한 댓글은 신고가 불가합니다.');
        }else{
            $report = BoardReport::where('table_id', $this->board->table_id)->where('comment_id', $this->reportCommentId)->where('user_id', auth()->user()->id)->exists();
            if ($report) {
                $this->dispatch('open-alert', type: 'warning', next: 'close', link: '', message: '이미 신고한 게시물입니다.');
            }else{
                BoardReport::insert([
                    'board_id' => $this->board->id,
                    'table_id' => $this->board->table_id,
                    'write_id' => $this->writeId,
                    'comment_id' => $this->reportCommentId,
                    'user_id' => auth()->user()->id,
                    'field' => $this->commentReport,
                    'target_user_id' => $comment->user_id,
                    'title' => mb_substr($comment->comment, 0, 100),
                ]);
                $this->dispatch('open-alert', type: 'success', next: 'close', link: '', message: '신고가 접수되었습니다.');
            }
        }
    }

}
