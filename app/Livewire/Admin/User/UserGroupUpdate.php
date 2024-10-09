<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserGroup;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserGroupUpdate extends Component
{
    use Toastable;

    public $groupId, $name, $level, $original_level, $comment;

    public function mount($editSelectedGroup): void
    {
        if ($editSelectedGroup){
            $this->name = $editSelectedGroup->name;
            $this->level = $editSelectedGroup->level;
            $this->original_level = $editSelectedGroup->level;
            $this->comment = $editSelectedGroup->comment;
            $this->groupId = $editSelectedGroup->id;
        }
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-group-update');
    }

    public function updateUserGroup(): void
    {
        $this->validate([
            'level' => ['required', Rule::unique('user_groups')->ignore($this->groupId)],
        ], [
            'level.required' => '레벨을 선택해주세요.',
            'level.unique' => '이미 사용중인 레벨입니다.',
        ]);

        try {
            $updateData = [
                'name' => $this->name,
                'level' => $this->level,
                'comment' => $this->comment,
            ];

            UserGroup::where('id', $this->groupId)->update($updateData);

            if ($this->original_level != $this->level) {
                User::where('group_level', $this->original_level)->update([
                    'group_level' => $this->level,
                ]);
            }

            $this->toastSuccess('정상적으로 수정되었습니다.');
            $this->dispatch('close-modal');
            $this->dispatch('reRenderParent');
        }catch (Exception $e) {
            Debugbar::error('UserGroupUpdate.updateUserGroup : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }
}
