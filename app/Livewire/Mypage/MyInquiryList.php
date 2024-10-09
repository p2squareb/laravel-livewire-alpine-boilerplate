<?php

namespace App\Livewire\Mypage;

use App\Models\Inquiry;
use App\Models\InquiryCategory;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MyInquiryList extends Component
{
    use WithPagination;

    public $inquiryCategories, $lastCategoryKey, $pageRows, $inquiryStatus, $pagePeriod, $searchString, $page, $category;

    protected $queryString = [
        'searchString' => ['except' => ''],
        'pageRows' => ['except' => '15'],
        'inquiryStatus' => ['except' => ''],
        'pagePeriod' => ['except' => 'all'],
        'page' => ['except' => 1]
    ];

    public function mount(): void
    {
        $this->inquiryCategories = InquiryCategory::all();
        $this->lastCategoryKey = count($this->inquiryCategories) - 1;
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $currentQueryString = [];
        if ($this->searchString != '') { $currentQueryString['searchString'] = $this->searchString; }
        if ($this->pageRows != '' && $this->pageRows != '15') { $currentQueryString['pageRows'] = $this->pageRows; }
        if ($this->inquiryStatus != '') { $currentQueryString['inquiryStatus'] = $this->inquiryStatus; }
        if ($this->pagePeriod != '' && $this->pagePeriod != 'all') { $currentQueryString['pagePeriod'] = $this->pagePeriod; }
        if ($this->page != '' && $this->page != '1') { $currentQueryString['page'] = $this->page; }

        return view('livewire.mypage.my-inquiry-list', [
            'inquiries' => $this->inquiries(),
            'currentQueryString' => $currentQueryString
        ]);
    }

    public function inquiries(): LengthAwarePaginator
    {
        $query = Inquiry::where('user_id', auth()->id());

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

    public function setCategory($category): void
    {
        $this->category = $category;
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchString', 'pageRows', 'inquiryStatus', 'pagePeriod', 'category'])) {
            $this->resetPage();
        }
    }

    public function updatedPage($page): void
    {
        $this->page = $page;
    }
}
