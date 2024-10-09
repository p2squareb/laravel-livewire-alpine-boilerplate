<?php

namespace App\Livewire\Admin\User;

use App\Livewire\File\FileControl;
use App\Models\User;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserCreate extends Component
{
    use Toastable;
    use WithFileUploads;

    private FileControl $fileControl;

    #[Validate('required', null, null, message: '닉네임을 입력해주세요.')]
    #[Validate('unique:users', null, null, message: '이미 사용중인 닉네임입니다.')]
    public $nickname;

    #[Validate('required', null, null, message: '이메일을 입력해주세요.')]
    #[Validate('email', null, null, message: '이메일 형식이 올바르지 않습니다.')]
    #[Validate('unique:users', null, null, message: '이미 사용중인 이메일입니다.')]
    public $email;

    #[Validate('required', null, null, message: '비밀번호를 입력해주세요.')]
    #[Validate('min:4', null, null, message: '비밀번호는 최소 4자 이상 입력해주세요.')]
    public $passwd;

    #[Validate('required', null, null, message: '비밀번호 확인을 입력해주세요.')]
    #[Validate('same:passwd', null, null, message: '비밀번호가 일치하지 않습니다.')]
    public $passwd_confirm;

    #[Validate('nullable|sometimes|image|mimes:jpeg,png,jpg,gif|max:3072', null, null, [
        'profile.image' => '이미지 파일만 업로드 가능합니다.',
        'profile.mimes' => '이미지는 jpeg, png, jpg, gif 형식만 가능합니다.',
        'profile.max' => '최대 3MB 업로드 가능합니다.',
    ])]
    public $profile;

    public function boot(FileControl $fileControl): void
    {
        $this->fileControl = $fileControl;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-create');
    }

    public function createUser(): void
    {
        $this->validate();

        $insertData = [
            'nickname' => $this->nickname,
            'email' => $this->email,
            'password' => bcrypt($this->passwd),
            'social_type' => 'email',
        ];

        if ($this->profile){
            $uploadFile = $this->fileControl->uploadProfileFile($this->profile);
            $profileData = [
                'profile_photo_path' => $uploadFile['fileSource'],
            ];
            $insertData = array_merge($insertData, $profileData);
        }

        try{
            User::create($insertData);

            $this->reset(['nickname', 'email', 'passwd', 'passwd_confirm', 'profile']);
            $this->toastSuccess('정상적으로 회원이 등록되었습니다.');
            $this->dispatch('close-modal');
            $this->dispatch('reRenderParentPage');
        }catch (Exception $e) {
            Debugbar::error('UserCreate.createUser : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }
}
