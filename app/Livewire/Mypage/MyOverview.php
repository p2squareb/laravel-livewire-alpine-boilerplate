<?php

namespace App\Livewire\Mypage;

use App\Livewire\File\FileControl;
use App\Models\BoardComment;
use App\Models\BoardRate;
use App\Models\BoardReport;
use App\Models\BoardWrite;
use App\Models\Inquiry;
use App\Models\LoginRecord;
use App\Models\User;
use App\Traits\BoardConfig;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyOverview extends Component
{
    use BoardConfig;
    use WithFileUploads;

    private FileControl $fileControl;
    public $profile;

    public function boot(FileControl $fileControl): void
    {
        $this->fileControl = $fileControl;
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-overview', [
            'loginRecordLatest' => $this->loginRecordLatest(),
            'inquiryList' => $this->inquiryList(),
            'activeCount' => $this->activeCount(),
        ]);
    }

    public function loginRecordLatest(): mixed
    {
        return LoginRecord::where('user_id', auth()->id())->orderBy('id', 'asc')->first();
    }

    public function inquiryList(): array|Collection|\Illuminate\Support\Collection
    {
        return Inquiry::where('user_id', auth()->id())->orderBy('id', 'desc')->limit(1)->get();
    }

    public function activeCount(): array
    {
        $writesCount = BoardWrite::where('user_id', auth()->id())->where('is_delete', 0)->count();
        $commentsCount = BoardComment::where('user_id', auth()->id())->where('is_delete', 0)->count();
        $rateUpCount = BoardRate::where('user_id', auth()->id())->where('rate', 'up')->count();
        $rateDownCount = BoardRate::where('user_id', auth()->id())->where('rate', 'down')->count();
        $reportsCount = BoardReport::where('user_id', auth()->id())->count();

        return [
            'writesCount' => $writesCount,
            'commentsCount' => $commentsCount,
            'rateUpCount' => $rateUpCount,
            'rateDownCount' => $rateDownCount,
            'reportsCount' => $reportsCount,
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
                'profile_photo_path' => $uploadFile['fileSource'],
            ];

            User::where('id', auth()->id())->update($profileData);
            $this->redirect(route('mypage.overview'), navigate: true);
        }catch (Exception $e) {
            Debugbar::error('MyOverview.updateProfileImage : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function deleteProfileImage(): void
    {
        try {
            $this->fileControl->deleteFileOnServer('profiles', auth()->user()->profile_photo_path);
            User::where('id', auth()->id())->update([
                'profile_photo_path' => null,
            ]);
            $this->redirect(route('mypage.overview'), navigate: true);
        }catch (Exception $e) {
            Debugbar::error('MyOverview.deleteProfileImage : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function updatedProfile(): void
    {
        if ($this->profile) {
            $this->updateProfileImage();
        }
    }
}
