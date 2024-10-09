<?php

namespace App\Livewire\Admin\User;

use App\Livewire\File\FileControl;
use App\Models\User;
use App\Models\UserDormant;
use App\Models\UserProhibit;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserRead extends Component
{
    use Toastable;
    use WithFileUploads;

    private FileControl $fileControl;
    public $userId, $profile, $profile_photo_path, $searchString, $searchResult, $searchUserId;

    public function boot(FileControl $fileControl): void
    {
        $this->fileControl = $fileControl;
    }

    public function mount($userId): void
    {
        $this->userId = $userId;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-read', [
            'userData' => $this->userData()
        ]);
    }

    public function userData(): array
    {
        $userInfo = User::where('id', $this->userId)->first();
        $this->profile_photo_path = $userInfo->profile_photo_path;

        $userProhibit = UserProhibit::where('user_id', $this->userId)->first();

        $userDormant = UserDormant::where('user_id', $this->userId)->first();

        return [
            'userInfo' => $userInfo,
            'userProhibit' => $userProhibit,
            'userDormant' => $userDormant,
        ];
    }

    public function updateProfileImage(): void
    {
        $this->validate([
            'profile' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif|max:3072',
        ], [
            'profile.image' => '이미지 파일만 업로드 가능합니다.',
            'profile.mimes' => '이미지는 jpeg, png, jpg, gif 형식만 가능합니다.',
            'profile.max' => '최대 3MB 업로드 가능합니다.',
        ]);

        try {
            $uploadFile = $this->fileControl->uploadProfileFile($this->profile);

            $profileData = [
                'profile_photo_name' => $uploadFile['fileName'],
                'profile_photo_path' => $uploadFile['fileSource'],
            ];

            User::where('id', $this->userId)->update($profileData);
            $this->toastSuccess('프로필 이미지가 수정되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('UserRead.updateProfileImage : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function deleteProfileImage(): void
    {
        try {
            $this->fileControl->deleteFileOnServer('profiles', $this->profile_photo_path);
            User::where('id', $this->userId)->update([
                'profile_photo_name' => null,
                'profile_photo_path' => null,
            ]);
            $this->toastSuccess('프로필 이미지가 삭제되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('UserRead.deleteProfileImage : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function updatedProfile(): void
    {
        if ($this->profile) {
            $this->updateProfileImage();
        }
    }

    public function search(): void
    {
        if (strlen($this->searchString) >= 2) {
            $query = User::selectRaw('id, nickname')->whereNotIn('group_level', [11,99]);
            $query->where(function ($query) {
                $query->where('email', 'like', '%'.$this->searchString.'%')
                    ->orWhere('nickname', 'like', '%'.$this->searchString.'%');
            });
            $this->searchResult = $query->get();
        }
    }

    public function updatedSearchUserId(): void
    {
        $this->userId = $this->searchUserId;
    }
}
