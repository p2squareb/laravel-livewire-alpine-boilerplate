<?php

namespace App\Livewire\Admin\Inquiry;

use App\Models\Inquiry;
use App\Services\NotificationService;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InquiryRead extends Component
{
    #[Validate('required', null, null, message: '답변을 입력해주세요.')]
    public $answer_content;

    public $inquiryId;

    public function mount($inquiryId): void
    {
        $this->inquiryId = $inquiryId;
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.inquiry.inquiry-read', [
            'inquiryData' => $this->inquiryData()
        ]);
    }

    public function inquiryData(): Inquiry
    {
        return Inquiry::find($this->inquiryId);
    }

    public function answerInquiry($stat): void
    {
        $this->validate();

        if ($stat === 1) {
            $msg = '성공적으로 답변이 등록되었습니다.';
        } else {
            $msg = '임시저장되었습니다.';
        }

        $updateData = [
            'status' => $stat,
            'answer_content' => $this->answer_content,
            'answer_user_id' => auth()->user()->id,
            'answer_writer' => auth()->user()->nickname,
            'answered_at' => now()
        ];

        try{
            Inquiry::where('id', $this->inquiryId)->update($updateData);

            $notificationService = new NotificationService();
            $notificationService->saveNotification('answerInquiry', $this->inquiryId);

            $this->dispatch('open-alert', type: 'success', next: 'redirect', link: route('admin.inquiry.list'), message: $msg);
        }catch (Exception $e) {
            Debugbar::error('BoardCreate.createBoard : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }
}
