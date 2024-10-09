<?php

namespace App\Livewire\Home;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

class SitePolicy extends Component
{
    public $policyId;

    public function mount($id): void
    {
        $this->policyId = $id;
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.home.site-policy');
    }
}
