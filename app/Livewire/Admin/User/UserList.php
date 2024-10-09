<?php

namespace App\Livewire\Admin\User;

use App\Livewire\File\FileControl;
use App\Models\User;
use App\Models\UserGroup;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserList extends Component
{
    use Toastable;
    use WithPagination;
    use WithFileUploads;

    public User $updateSelectedUser;
    private FileControl $fileControl;

    public $userGroup;
    public $selectedRows = [];
    public $selectAllRow = false;
    public $deleteRowId = null;
    public $group, $newGroup, $status, $page, $pageRows = 15, $searchKind, $searchString;

    protected $listeners = ['deleteRow' => 'deleteUser', 'deleteSelectedRows' => 'deleteSelectedUsers', 'reRenderParentPage'];

    protected $queryString = [
        'searchKind' => ['except' => ''],
        'searchString' => ['except' => ''],
        'pageRows' => ['except' => '15'],
        'page' => ['except' => 1],
        'group' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function boot(FileControl $fileControl): void
    {
        $this->fileControl = $fileControl;
    }

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
        $currentQueryString = [];
        if ($this->searchKind != '') { $currentQueryString['searchKind'] = $this->searchKind; }
        if ($this->searchString != '') { $currentQueryString['searchString'] = $this->searchString; }
        if ($this->pageRows != '' && $this->pageRows != '15') { $currentQueryString['pageRows'] = $this->pageRows; }
        if ($this->page != '' && $this->page != '1') { $currentQueryString['page'] = $this->page; }
        if ($this->group != '') { $currentQueryString['group'] = $this->group; }
        if ($this->status != '') { $currentQueryString['status'] = $this->status; }

        return view('livewire.admin.user.user-list', [
            'users' => $this->users(),
            'currentQueryString' => $currentQueryString
        ]);
    }

    public function users(): LengthAwarePaginator
    {
        if (auth()->user()->group_level == 99) {
            $query = User::whereNotIn('group_level', [99]);
        } else {
            $query = User::whereNotIn('group_level', [11,99]);
        }

        if (!empty($this->group)){
            $query->where('group_level', $this->group);
        }

        if (!empty($this->status)){
            $query->where('status', $this->status);
        }else{
            $query->where('status', '>', 0);
        }

        if ($this->searchKind !== null && $this->searchKind !== '' && $this->searchString !== null && $this->searchString !== '') {
            $query->where($this->searchKind, 'like', '%'. $this->searchString. '%');
        }

        return $query->orderBy('id', 'desc')->paginate($this->pageRows)->onEachSide(2);
    }

    public function moveGroupUsers(): void
    {
        if (empty($this->selectedRows) || empty($this->newGroup)) {
            return;
        }

        try {
            User::whereIn('id', $this->selectedRows)->update([
                'group_level' => $this->newGroup,
            ]);
            $this->selectAllRow = false;
            $this->selectedRows = [];
            $this->reset(['newGroup']);
            $this->toastSuccess('정상적으로 회원의 그룹이 변경되었습니다.');
            $this->dispatch('close-confirm');
        } catch (Exception $e) {
            Debugbar::error('UserWithdrawalList.restoreSelectedUsers : ' . $e->getMessage());
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
        if (in_array($propertyName, ['searchKind', 'searchString', 'pageRows', 'group', 'status'])) {
            $this->resetPage();
        }
    }

    public function updatedPage($page): void
    {
        $this->page = $page;
    }

    public function reRenderParentPage(): void
    {
        $this->selectedRows = [];
        $this->selectAllRow = false;
        $this->render();
        $this->resetPage();
    }



    public function deleteUser(): void
    {
        try{
            $user = User::find($this->deleteRowId);
            if (!is_null($user->profile_photo_path)) {
                $this->fileControl->deleteFileOnServer('profiles', $user->profile_photo_path);
            }
            User::find($this->deleteRowId)->delete();
            $this->deleteRowId = null;
            $this->toastSuccess('정상적으로 회원이 삭제되었습니다.');
            $this->dispatch('close-alert');
        }catch (Exception $e) {
            Log::error('UserList.deleteUser : ' . $e->getMessage());
            $this->toastFail('회원 삭제에 실패하였습니다.');
        }
    }

    public function deleteSelectedUsers(): void
    {
        try {
            $column = 'id';
            $users = User::whereIn($column, $this->selectedRows)->get();
            foreach ($users as $user) {
                if (!is_null($user->profile_photo_path)) {
                    $this->fileControl->deleteFileOnServer('profiles', $user->profile_photo_path);
                }
            }
            User::whereIn($column, $this->selectedRows)->delete();
            $this->selectAllRow = false;
            $this->selectedRows = [];
            $this->toastSuccess('정상적으로 회원이 삭제되었습니다.');
            $this->dispatch('close-alert');
        } catch (Exception $e) {
            Log::error('UserList.deleteSelectedUsers : ' . $e->getMessage());
            $this->toastFail('회원 삭제에 실패하였습니다.');
        }
    }
}
