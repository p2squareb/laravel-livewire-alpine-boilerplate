<?php

namespace App\Livewire\Admin\Board;

use App\Models\Board;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BoardUpdate extends Component
{
    #[Validate('required', null, null, message: '게시판명을 입력해주세요.')]
    public $table_name;

    #[Validate('required', null, null, message: '스킨을 선택해주세요.')]
    public $skin;

    #[Validate('required_if:use_category,1', null, null, message: '카테고리 항목을 입력해주세요.')]
    public $category_list;

    public $table_id, $use_category, $status, $use_comment, $use_rate, $use_report, $write_level;

    public $boardId, $skins = [];

    public function mount($boardId): void
    {
        $this->boardId = $boardId;
        $this->getBoard($boardId);
        $this->skins = getFolderNames(resource_path('views/livewire/board'));
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.board.board-update');
    }

    public function getBoard($boardId): void
    {
        $board = Board::find($boardId);

        $this->table_name = $board->table_name;
        $this->table_id = $board->table_id;
        $this->skin = $board->skin;
        $this->use_category = $board->use_category;
        $this->category_list = $board->category_list;
        $this->status = $board->status;
        $this->use_comment = $board->use_comment;
        $this->use_rate = $board->use_rate;
        $this->use_report = $board->use_report;
        $this->write_level = $board->write_level;
    }

    public function updateBoard(): void
    {
        $this->validate();

        $updateData = [
            'table_name' => $this->table_name,
            'skin' => $this->skin,
            'use_category' => $this->use_category,
            'category_list' => $this->category_list,
            'status' => $this->status,
            'use_comment' => $this->use_comment,
            'use_rate' => $this->use_rate,
            'use_report' => $this->use_report,
            'write_level' => $this->write_level,
        ];

        try{
            Board::where('id', $this->boardId)->update($updateData);
            $this->dispatch('open-alert', type: 'success', next: 'redirect', link: route('admin.board.list'), message: '성공적으로 게시판이 수정되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardUpdate.updateBoard : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function updatedSkin(): void
    {
        if ($this->skin === 'faq') {
            $this->write_level = 11;
            $this->use_comment = 0;
            $this->use_report = 0;
            $this->use_rate = 0;
        }
    }
}
