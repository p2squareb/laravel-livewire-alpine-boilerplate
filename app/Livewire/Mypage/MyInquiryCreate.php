<?php

namespace App\Livewire\Mypage;

use App\Models\Inquiry;
use App\Models\InquiryCategory;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyInquiryCreate extends Component
{
    use WithFileUploads;

    public $inquiryCategories, $subject, $content, $categories;

    public function mount(): void
    {
        $this->inquiryCategories = InquiryCategory::all();
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-inquiry-create');
    }

    public function createInquiry(): void
    {
        $this->validate();

        $insertData = [
            'categories' => $this->categories,
            'subject' => $this->subject,
            'content' => $this->content,
            'ip' => request()->ip(),
        ];

        $insertData['user_id'] = auth()->user()->id;
        $insertData['writer'] = auth()->user()->nickname;

        try{
            Inquiry::create($insertData);
            $this->dispatch('open-alert', type: 'success', next: 'redirect', link: route('mypage.inquiry.list'), message: '성공적으로 1:1문의가 등록되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('BoardCreate.createBoard : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    protected function rules(): array
    {
        return [
            'subject' => 'required',
            'content' => 'required',
            'categories' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'subject.required' => '제목을 입력해주세요.',
            'content.required' => '내용을 입력해주세요.',
            'categories.required' => '카테고리를 선택해주세요.',
        ];
    }
}
