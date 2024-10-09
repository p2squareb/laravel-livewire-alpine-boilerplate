<?php

namespace App\Livewire\Mypage;

use App\Models\Inquiry;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MyInquiryRead extends Component
{
    public $inquiryId;

    public function mount($inquiryId): void
    {
        $this->inquiryId = $inquiryId;
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.mypage.my-inquiry-read', [
            'inquiryData' => $this->inquiryData()
        ]);
    }

    public function inquiryData(): Inquiry
    {
        return Inquiry::find($this->inquiryId);
    }
}
