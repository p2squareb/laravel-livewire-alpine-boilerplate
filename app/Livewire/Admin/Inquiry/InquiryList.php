<?php

namespace App\Livewire\Admin\Inquiry;

use App\Models\Board;
use App\Models\Inquiry;
use App\Models\InquiryCategory;
use App\Traits\Toastable;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class InquiryList extends Component
{
    use Toastable;
    use WithPagination;

    public $inquiryCategories, $pageRows, $inquiryStatus, $searchString, $page, $category;

    protected $queryString = [
        'searchString' => ['except' => ''],
        'pageRows' => ['except' => '15'],
        'inquiryStatus' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function mount(): void
    {
        $this->inquiryCategories = InquiryCategory::all();
    }

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $currentQueryString = [];
        if ($this->searchString != '') { $currentQueryString['searchString'] = $this->searchString; }
        if ($this->pageRows != '' && $this->pageRows != '15') { $currentQueryString['pageRows'] = $this->pageRows; }
        if ($this->inquiryStatus != '') { $currentQueryString['inquiryStatus'] = $this->inquiryStatus; }
        if ($this->page != '' && $this->page != '1') { $currentQueryString['page'] = $this->page; }

        return view('livewire.admin.inquiry.inquiry-list', [
            'inquiries' => $this->inquiries(),
            'currentQueryString' => $currentQueryString
        ]);
    }

    public function inquiries(): LengthAwarePaginator
    {
        $query = Inquiry::query();

        if (!empty($this->category)) {
            $query->where('categories', $this->category);
        }

        if (!empty($this->searchString)) {
            $query->where(function ($query) {
                $query->where('subject', 'like', '%'.$this->searchString.'%')
                    ->orWhere('content', 'like', '%'.$this->searchString.'%');
            });
        }

        if (!empty($this->inquiryStatus)) {
            $query->where('status', $this->inquiryStatus);
        }

        if (empty($this->pageRows)) $this->pageRows = 15;

        return $query->orderBy('id', 'desc')->paginate($this->pageRows);
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchString', 'pageRows', 'inquiryStatus', 'category'])) {
            $this->resetPage();
        }
    }

    public function updatedPage($page): void
    {
        $this->page = $page;
    }
}
