<?php

namespace App\Livewire\Admin\System;

use App\Models\System;
use App\Traits\Toastable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Basic extends Component
{
    use Toastable;

    #[Validate('required', null, null, message: '사이트명을 입력해주세요.')]
    public $site_name;

    #[Validate('required', null, null, message: '도메인을 입력해주세요.')]
    public $domain_name;

    #[Validate('required', null, null, message: '대표 이메일을 입력해주세요.')]
    #[Validate('email', null, null, message: '이메일 형식이 올바르지 않습니다.')]
    public $sq_email;

    public $use_smtp, $use_external_email, $use_dormant, $image_resize, $image_width_max;

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->basic();
        return view('livewire.admin.system.basic');
    }

    protected function basic(): void
    {
        $basic = System::where('title', 'basic')->orderByDesc('id')->first();
        $data = json_decode($basic->content);
        $this->site_name = $data->basic->site_name;
        $this->domain_name = $data->basic->domain_name;
        $this->sq_email = $data->basic->sq_email;
        $this->use_smtp = $data->basic->use_smtp;
        $this->use_external_email = $data->basic->use_external_email;
        $this->use_dormant = $data->basic->use_dormant;
        $this->image_resize = $data->image->image_resize;
        $this->image_width_max = $data->image->image_width_max;
    }

    public function updateBasic(): void
    {
        $this->validate();

        $configData = [
            'basic' => [
                'site_name' => $this->site_name,
                'domain_name' => $this->domain_name,
                'sq_email' => $this->sq_email,
                'use_smtp' => $this->use_smtp ?? '0',
                'use_external_email' => $this->use_external_email ?? '0',
                'use_dormant' => $this->use_dormant ?? '0',
            ],
            'image' => [
                'image_resize' => $this->image_resize,
                'image_width_max' => $this->image_width_max,
            ],
        ];

        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'basic',
            'content' => json_encode($configData),
        ]);

        Cache::forget("config.basic");

        $this->toastSuccess('기본 설정이 변경되었습니다.');
    }

}
