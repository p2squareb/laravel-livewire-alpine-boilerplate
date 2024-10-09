<?php

namespace App\Livewire\Admin\Point;

use App\Models\User;
use App\Models\UserGroup;
use App\Services\PointService;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PointCreate extends Component
{
    use Toastable;

    #[Validate('required', null, null, message: '지급/차감할 회원을 선택해주세요.')]
    public $selectedUserIds = [];

    #[Validate('required', null, null, message: '지급 금액을 입력해주세요.')]
    public $amount;

    #[Validate('required', null, null, message: '사유를 입력해주세요.')]
    public $reason;

    public $selectedUsers = [];
    public $userGroup, $point_type = 'P';
    public $group, $searchString;

    public function mount(): void
    {
        if (auth()->user()->group_level == 99) {
            $this->userGroup = UserGroup::where('level', '<', 99)->orderBy('level')->get();
        } else {
            $this->userGroup = UserGroup::where('level', '<', 11)->orderBy('level')->get();
        }
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.point.point-create', [
            'searchUsers' => $this->searchUsers(),
        ]);
    }

    public function searchUsers(): array|\Illuminate\Database\Eloquent\Collection|Collection
    {
        if (!empty($this->group) || !empty($this->searchString)) {
            $query = User::where('group_level', '<', 99);

            if (!empty($this->group)) {
                $query->where('group_level', $this->group);
            }
            if (!empty($this->searchString)) {
                $query->where(function ($query) {
                    $query->where('nickname', 'like', '%' . $this->searchString . '%')
                        ->orWhere('email', 'like', '%' . $this->searchString . '%');
                });
            }
            return $query->orderBy('nickname')->get();
        }else{
            return [];
        }
    }

    public function updatedSelectedUserIds(): void
    {
        $this->selectedUsers = User::whereIn('id', $this->selectedUserIds)->orderBy('nickname')->get();
    }

    public function removeSelectedUser($userId): void
    {
        $this->selectedUserIds = array_filter($this->selectedUserIds, function($id) use ($userId) {
            return $id != $userId;
        });
        $this->selectedUsers = User::whereIn('id', $this->selectedUserIds)->orderBy('nickname')->get();
    }

    public function createPoint(PointService $pointService): void
    {
        $this->validate();

        try{
            foreach($this->selectedUserIds as $userId){
                if ($this->point_type === 'M') {
                    $amount = $this->amount * -1;
                } else {
                    $amount = $this->amount;
                }
                $pointService->savePointByAdmin($this->point_type, $userId, auth()->id(), $this->reason, $amount);
            }

            $this->reason = '';
            $this->reset(['selectedUserIds', 'selectedUsers', 'group', 'searchString', 'amount']);
            $this->toastSuccess('정상적으로 포인트가 지급/차감되었습니다.');
            $this->dispatch('close-modal');
            $this->dispatch('reRenderParentPage');
            $this->render();
        }catch (Exception $e) {
            Debugbar::error('PointCreate.createPoint : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }
}
