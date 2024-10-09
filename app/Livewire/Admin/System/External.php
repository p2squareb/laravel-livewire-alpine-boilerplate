<?php

namespace App\Livewire\Admin\System;

use App\Models\System;
use App\Traits\Toastable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

class External extends Component
{
    use Toastable;

    public $use_sns, $google_client_id;

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->external();
        return view('livewire.admin.system.external');
    }

    protected function external(): void
    {
        $external = System::where('title', 'external')->orderByDesc('id')->first();
        $data = json_decode($external->content);
        $this->use_sns = $data->socialLogin->use_sns;
        $this->google_client_id = $data->socialLogin->google->client_id;
    }

    public function updateExternal(): void
    {
        $configData = [
            'socialLogin' => [
                'use_sns' => $this->use_sns,
                'google' => [
                    'client_id' => $this->google_client_id,
                ],
            ],
        ];

        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'external',
            'content' => json_encode($configData),
        ]);

        Cache::forget("config.external");

        $this->toastSuccess('외부 서비스 설정이 변경되었습니다.');
    }
}
