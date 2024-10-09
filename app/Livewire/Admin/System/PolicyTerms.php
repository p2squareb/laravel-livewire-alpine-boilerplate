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

class PolicyTerms extends Component
{
    use Toastable;

    public $terms, $policy;

    public function mount(): void
    {
        $this->policyTerms();
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.system.policy-terms');
    }

    public function updatePolicyTerms(): void
    {
        $configData = [
            'policy' => [
                'terms' => $this->terms,
                'policy' => $this->policy,
            ],
        ];

        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'policy',
            'content' => json_encode($configData),
        ]);

        Cache::forget("config.policy");

        $this->toastSuccess('이용약관 / 개인정보처리방침 설정이 변경되었습니다.');
    }

    public function policyTerms(): void
    {
        $policyTerms = System::where('title', 'policy')->orderByDesc('id')->first();
        $data = json_decode($policyTerms->content);
        $this->terms = $data->{'policy'}->terms;
        $this->policy = $data->{'policy'}->policy;
    }
}
