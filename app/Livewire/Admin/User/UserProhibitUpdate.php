<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserProhibit as Prohibit;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class UserProhibitUpdate extends Component
{
    use Toastable;

    #[Validate('required_if:gubun,1', null, null, message: '정지기간을 선택해주세요.')]
    public $period_type;

    #[Validate('required_if:gubun,1', null, null, message: '사유를 입력해주세요.')]
    public $cause;

    public $selectedRows = [], $gubun = '1', $until_date;

    public function mount($prohibitSelectedUser): void
    {
        $this->selectedRows = $prohibitSelectedUser;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-prohibit-update');
    }

    public function prohibitUser(): void
    {
        $this->validate();

        try {
            if ($this->gubun === '1') {
                $this->until_date = calDateByPeriod($this->period_type);

                $users = User::whereIn('id', $this->selectedRows)->where('status', '<>', 3)->get();
                foreach($users as $user) {
                    $insertData = [
                        'user_id' => $user->id,
                        'gubun' => $this->gubun,
                        'period_type' => $this->period_type,
                        'until_date' => $this->until_date,
                        'cause' => $this->cause,
                        'processed_by_user_id' => auth()->id(),
                        'processed_by_user_nickname' => auth()->user()->nickname,
                    ];
                    Prohibit::create($insertData);

                    User::where('id', $user->id)->update([
                        'status' => 3,
                    ]);
                }
                $this->toastSuccess('정상적으로 사용자가 정지되었습니다.');
            } elseif ($this->gubun === '0') {
                $users = User::whereIn('id', $this->selectedRows)->where('status', 3)->get();
                foreach($users as $user){
                    $updateData = [
                        'gubun' => 0,
                    ];
                    Prohibit::where('user_id', $user->id)->update($updateData);

                    User::where('id', $user->id)->update([
                        'status' => 1,
                    ]);
                }

                $this->toastSuccess('정상적으로 사용자가 정지해제되었습니다.');
            }
            $this->dispatch('close-modal');
            $this->dispatch('reRenderParentPage');
        } catch (Exception $e) {
            Debugbar::error('UserProhibitUpdate.prohibitUser : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }
}
