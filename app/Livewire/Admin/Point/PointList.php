<?php

namespace App\Livewire\Admin\Point;

use App\Exports\PointsExport;
use App\Models\Point;
use App\Traits\Toastable;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PointList extends Component
{
    use Toastable;
    use WithPagination;

    public $pointType, $pagePeriod, $pageRows = 15, $searchKind, $searchString;

    protected $listeners = ['reRenderParentPage'];

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.point.point-list', [
            'points_list' => $this->points(),
        ]);
    }

    public function points(): LengthAwarePaginator
    {

        $query = Point::with('user');

        if (!empty($this->pointType)) {
            $query->where('point_type', $this->pointType);
        }

        if (!empty($this->pagePeriod)) {
            if ($this->pagePeriod === '7' || $this->pagePeriod === '30') {
                $query->where('created_at', '>=', Carbon::now()->subDays($this->pagePeriod));
            }else if ($this->pagePeriod === '3m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(3));
            }else if ($this->pagePeriod === '6m') {
                $query->where('created_at', '>=', Carbon::now()->subMonths(6));
            }else if ($this->pagePeriod === '1y') {
                $query->where('created_at', '>=', Carbon::now()->subYear());
            }
        }

        if ($this->searchKind !== null && $this->searchKind !== '' && $this->searchString !== null && $this->searchString !== '') {
            $query->whereHas('user', function ($query) {
                $query->where($this->searchKind, 'like', '%'. $this->searchString. '%');
            });
        }

        return $query->orderBy('id', 'desc')->paginate($this->pageRows);
    }

    public function excelExport(): BinaryFileResponse
    {
        return Excel::download(new PointsExport($this->pointType, $this->pagePeriod), 'points.xlsx');
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchKind', 'searchString', 'pageRows', 'pointType', 'pagePeriod'])) {
            $this->resetPage();
        }
    }

    public function reRenderParentPage(): void
    {
        $this->render();
        $this->resetPage();
    }
}
