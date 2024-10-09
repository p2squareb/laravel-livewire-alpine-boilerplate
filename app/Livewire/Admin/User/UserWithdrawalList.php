<?php

namespace App\Livewire\Admin\User;

use App\Livewire\File\FileControl;
use App\Models\User;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserWithdrawalList extends Component
{
    use Toastable;
    use WithPagination;
    use WithFileUploads;

    private FileControl $fileControl;
    public $selectedRows = [], $selectAllRow = false, $pageRows = 15, $pagePeriod, $searchKind, $searchString;

    protected $listeners = ['restoreSelectedRows' => 'restoreSelectedUsers', 'deleteSelectedRows' => 'deleteSelectedUsers'];

    public function boot(FileControl $fileControl): void
    {
        $this->fileControl = $fileControl;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-withdrawal-list', [
            'users' => $this->users(),
        ]);
    }

    public function users(): LengthAwarePaginator
    {
        $query = User::where('status', 2)->whereNotIn('group_level', [11,99]);

        if ($this->searchKind !== null && $this->searchKind !== '' && $this->searchString !== null && $this->searchString !== '') {
            $query->where($this->searchKind, 'like', '%'. $this->searchString. '%');
        }

        if (!empty($this->pagePeriod)) {
            if ($this->pagePeriod === '7' || $this->pagePeriod === '30') {
                $query->where('created_at', '>=', Carbon::now()->subDays($this->pagePeriod));
            }else if ($this->pagePeriod === '3m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(3));
            }else if ($this->pagePeriod === '6m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
            }else if ($this->pagePeriod === '1y') {
                $query->where('created_at', '>=', Carbon::now()->subYear());
            }
        }

        return $query->orderBy('id', 'desc')->paginate($this->pageRows);
    }

    public function restoreSelectedUsers(): void
    {
        try {
            User::whereIn('id', $this->selectedRows)->update([
                'status' => 1,
                'leaved_at' => null,
            ]);
            $this->selectAllRow = false;
            $this->selectedRows = [];
            $this->toastSuccess('정상적으로 회원의 상태가 변경되었습니다.');
            $this->dispatch('close-confirm');
        } catch (Exception $e) {
            Debugbar::error('UserWithdrawalList.restoreSelectedUsers : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function deleteSelectedUsers(): void
    {
        try {
            $users = User::whereIn('id', $this->selectedRows)->get();
            foreach ($users as $user) {
                if (!is_null($user->profile_photo_source)) {
                    $this->fileControl->deleteFileOnServer('profiles', $user->profile_photo_path);
                }
            }
            User::whereIn('id', $this->selectedRows)->update([
                'status' => 0,
                'name' => null,
                'password' => null,
                'cellphone' => null,
                'zipcode' => null,
                'addr1' => null,
                'addr2' => null,
                'social_type' => null,
                'profile_photo_path' => null,
            ]);
            $this->selectAllRow = false;
            $this->selectedRows = [];
            $this->toastSuccess('정상적으로 회원이 삭제되었습니다.');
            $this->dispatch('close-confirm');
        } catch (Exception $e) {
            Debugbar::error('UserWithdrawalList.deleteSelectedUsers : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function updatedSelectAllRow(): void
    {
        if ($this->selectAllRow) {
            $this->selectedRows = $this->users()->getCollection()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selectedRows = [];
        }
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchKind', 'searchString', 'pageRows', 'pagePeriod'])) {
            $this->resetPage();
        }
    }
}
