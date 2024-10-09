<?php

namespace App\Livewire\Admin\User;

use App\Models\UserGroup;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserGroupCreate extends Component
{
    use Toastable;

    #[Validate('required', null, null, message: '그룹명을 입력해주세요.')]
    public $name;

    #[Validate('required', null, null, message: '레벨을 선택해주세요.')]
    #[Validate('unique:user_groups', null, null, message: '이미 사용중인 레벨입니다.')]
    public $level;

    public $comment;

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-group-create');
    }

    public function createUserGroup(): void
    {
        $this->validate();

        $insertData = [
            'name' => $this->name,
            'level' => $this->level,
            'comment' => $this->comment,
        ];

        try{
            UserGroup::create($insertData);

            $this->reset(['name', 'level', 'comment']);
            $this->toastSuccess('정상적으로 그룹이 생성되었습니다.');
            $this->dispatch('close-modal');
            $this->dispatch('reRenderParent');
        }catch (Exception $e) {
            Debugbar::error('UserGroupCreate.createUserGroup : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }
}
