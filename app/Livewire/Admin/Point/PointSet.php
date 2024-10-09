<?php

namespace App\Livewire\Admin\Point;

use App\Models\System;
use App\Traits\Toastable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PointSet extends Component
{
    use Toastable;

    public $use_point_join, $use_point_join_amt, $use_point_login, $use_point_login_amt;
    public $use_point_write, $use_point_write_amt, $use_point_write_comment, $use_point_write_comment_amt, $use_point_write_up, $use_point_write_up_amt, $use_point_write_down, $use_point_write_down_amt;
    public $use_point_comment, $use_point_comment_amt, $use_point_comment_up, $use_point_comment_up_amt, $use_point_comment_down, $use_point_comment_down_amt;

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->point();
        return view('livewire.admin.point.point-set');
    }

    protected function point(): void
    {
        $point = System::where('title', 'point')->orderByDesc('id')->first();
        $data = json_decode($point->content);

        $this->use_point_join = $data->point->use_point_join;
        $this->use_point_join_amt = $data->point->use_point_join_amt;
        $this->use_point_login = $data->point->use_point_login;
        $this->use_point_login_amt = $data->point->use_point_login_amt;
        $this->use_point_write = $data->point->use_point_write;
        $this->use_point_write_amt = $data->point->use_point_write_amt;
        $this->use_point_write_comment = $data->point->use_point_write_comment;
        $this->use_point_write_comment_amt = $data->point->use_point_write_comment_amt;
        $this->use_point_write_up = $data->point->use_point_write_up;
        $this->use_point_write_up_amt = $data->point->use_point_write_up_amt;
        $this->use_point_write_down = $data->point->use_point_write_down;
        $this->use_point_write_down_amt = $data->point->use_point_write_down_amt;
        $this->use_point_comment = $data->point->use_point_comment;
        $this->use_point_comment_amt = $data->point->use_point_comment_amt;
        $this->use_point_comment_up = $data->point->use_point_comment_up;
        $this->use_point_comment_up_amt = $data->point->use_point_comment_up_amt;
        $this->use_point_comment_down = $data->point->use_point_comment_down;
        $this->use_point_comment_down_amt = $data->point->use_point_comment_down_amt;
    }

    public function updatePoint(): void
    {
        $configData = [
            'point' => [
                'use_point_join' => $this->use_point_join ?? '0',
                'use_point_join_amt' => $this->use_point_join_amt ?? '0',
                'use_point_login' => $this->use_point_login ?? '0',
                'use_point_login_amt' => $this->use_point_login_amt ?? '0',
                'use_point_write' => $this->use_point_write ?? '0',
                'use_point_write_amt' => $this->use_point_write_amt ?? '0',
                'use_point_write_comment' => $this->use_point_write_comment ?? '0',
                'use_point_write_comment_amt' => $this->use_point_write_comment_amt ?? '0',
                'use_point_write_up' => $this->use_point_write_up ?? '0',
                'use_point_write_up_amt' => $this->use_point_write_up_amt ?? '0',
                'use_point_write_down' => $this->use_point_write_down ?? '0',
                'use_point_write_down_amt' => $this->use_point_write_down_amt ?? '0',
                'use_point_comment' => $this->use_point_comment ?? '0',
                'use_point_comment_amt' => $this->use_point_comment_amt ?? '0',
                'use_point_comment_up' => $this->use_point_comment_up ?? '0',
                'use_point_comment_up_amt' => $this->use_point_comment_up_amt ?? '0',
                'use_point_comment_down' => $this->use_point_comment_down ?? '0',
                'use_point_comment_down_amt' => $this->use_point_comment_down_amt ?? '0',
            ],
        ];

        System::insert([
            'register_ip' => request()->ip(),
            'register_id' => 'system',
            'title' => 'point',
            'content' => json_encode($configData),
        ]);

        Cache::forget("config.point");

        $this->toastSuccess('포인트 설정이 변경되었습니다.');
    }
}
