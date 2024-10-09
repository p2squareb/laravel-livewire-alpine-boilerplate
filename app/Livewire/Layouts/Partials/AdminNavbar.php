<?php

namespace App\Livewire\Layouts\Partials;

use App\Models\BoardReport;
use App\Models\Inquiry;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class AdminNavbar extends Component
{
    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.layouts.partials.admin-navbar', [
            'notification' => $this->adminNotificationCount(),
        ]);
    }

    protected function adminNotificationCount(): array
    {
        $checkInquiryCount = Inquiry::where('is_delete', 0)->where('status', 0)->count();
        $checkReportCount = BoardReport::where('status', 0)->count();

        return [
            'inquiry' => $checkInquiryCount,
            'report' => $checkReportCount,
            'total' => $checkInquiryCount + $checkReportCount,
        ];
    }
}
