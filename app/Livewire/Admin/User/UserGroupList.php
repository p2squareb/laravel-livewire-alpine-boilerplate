<?php

namespace App\Livewire\Admin\User;

use App\Models\UserGroup;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserGroupList extends Component
{
    use Toastable;

    public UserGroup $editSelectedGroup;
    public $deleteRowId = null;

    protected $listeners = ['deleteRow' => 'deleteUserGroup', 'reRenderParent' => 'reRenderParent'];

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-group-list', [
            'userGroups' => $this->userGroups(),
        ]);
    }

    public function userGroups(): Collection|array|\Illuminate\Support\Collection
    {
        return UserGroup::withCount('users')->where('level', '<>', 99)->get();
    }

    public function editUserGroup(UserGroup $group): void
    {
        $this->editSelectedGroup = $group;
        $this->dispatch('open-modal', modalId: 'edit-user-group-modal');
    }

    public function deleteUserGroup(): void
    {
        try{
            UserGroup::find($this->deleteRowId)->delete();
            $this->deleteRowId = null;
            $this->toastSuccess('정상적으로 그룹이 삭제되었습니다.');
            $this->dispatch('close-confirm');
        }catch (Exception $e) {
            Debugbar::error('UserGroupList.deleteUserGroup : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function reRenderParent(): void
    {
        $this->render();
    }
}
