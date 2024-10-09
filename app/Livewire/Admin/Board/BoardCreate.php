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

class BoardCreate extends Component
{
    #[Validate('required', null, null, message: '게시판명을 입력해주세요.')]
    public $table_name;

    #[Validate('required', null, null, message: '게시판ID를 입력해주세요.')]
    #[Validate('regex:/^[a-zA-Z]+$/', null, null, message: '게시판ID는 영문자만 입력 가능합니다.')]
    #[Validate('unique:boards,table_id', null, null, message: '이미 사용중인 게시판ID입니다.')]
    public $table_id;

    #[Validate('required', null, null, message: '스킨을 선택해주세요.')]
    public $skin = null;

    #[Validate('required_if:use_category,1', null, null, message: '카테고리 항목을 입력해주세요.')]
    public $category_list;

    public $use_category=0, $status=1, $use_comment=1, $use_rate=1, $use_report=1, $write_level=1;

    public $skins = [];

    public function mount(): void
    {
        $this->skins = getFolderNames(resource_path('views/livewire/board'));
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.board.board-create');
    }

    public function createBoard(): void
    {
        $this->validate();

        $insertData = [
            'table_id' => $this->table_id,
            'table_name' => $this->table_name,
            'status' => $this->status,
            'use_category' => $this->use_category,
            'category_list' => $this->category_list,
            'write_level' => $this->write_level,
            'use_comment' => $this->use_comment,
            'use_rate' => $this->use_rate,
            'use_report' => $this->use_report,
            'skin' => $this->skin,
        ];

        try{
            Board::create($insertData);
            $this->dispatch('open-alert', type: 'success', next: 'redirect', link: route('admin.board.list'), message: '성공적으로 게시판이 생성되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardCreate.createBoard : ' . $e->getMessage());
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
