<?php

namespace App\Livewire\Admin\User;

use App\Livewire\File\FileControl;
use App\Models\User;
use App\Models\UserDormant;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserDormantList extends Component
{
    use Toastable;
    use WithPagination;
    use WithFileUploads;

    private FileControl $fileControl;
    public $deleteRowId = null, $pageRows = 15, $status = '', $searchKind, $searchString;

    protected $listeners = ['deleteRow' => 'deleteUser'];

    public function boot(FileControl $fileControl): void
    {
        $this->fileControl = $fileControl;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-dormant-list', [
            'dormants' => $this->dormantUsers(),
        ]);
    }

    public function dormantUsers(): LengthAwarePaginator
    {
        $query = UserDormant::query();

        if ($this->status !== ''){
            $query->where('gubun', $this->status);
        }

        if ($this->searchKind !== null && $this->searchKind !== '' && $this->searchString !== null && $this->searchString !== '') {
            $query->where($this->searchKind, 'like', '%'. $this->searchString. '%');
        }

        return $query->orderBy('id', 'desc')->paginate($this->pageRows)->onEachSide(2);
    }

    public function deleteUser(): void
    {
        try {
            $user = User::where('id', $this->deleteRowId)->first();
            if (!is_null($user->profile_photo_source)) {
                $this->fileControl->deleteFileOnServer('profiles', $user->profile_photo_path);
            }

            User::where('id', $this->deleteRowId)->update([
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

            $this->toastSuccess('정상적으로 회원이 삭제되었습니다.');
            $this->dispatch('close-confirm');
        } catch (Exception $e) {
            Debugbar::error('UserDormantList.deleteUsers : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchKind', 'searchString', 'pageRows', 'pagePeriod'])) {
            $this->resetPage();
        }
    }
}
