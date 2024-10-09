<?php

namespace App\Livewire\Board;

use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class WriteList extends Component
{
    use BoardConfig;
    use WithPagination;

    public $board;
    public $tableId;
    public $isWrite = false;
    public $fileTable = 'files';
    public $pageRows, $pageOrder, $pagePeriod, $searchKind='', $searchString, $page, $category, $accordion_selected = 0;

    protected $queryString = [
        'searchKind' => ['except' => ''],
        'searchString' => ['except' => ''],
        'pageRows' => ['except' => '15'],
        'pageOrder' => ['except' => 'created_at'],
        'pagePeriod' => ['except' => 'all'],
        'page' => ['except' => 1]
    ];

    public function mount($tableId): void
    {
        $this->tableId = $tableId;
        $this->board = $this->getBoard($tableId);

        $baseLevel = 0;
        if(auth()->check()) {
            $baseLevel = auth()->user()->group_level;
        }
        if($baseLevel >= $this->board->write_level) {
            $this->isWrite = true;
        }
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $currentQueryString = [];
        if ($this->searchKind != '') { $currentQueryString['searchKind'] = $this->searchKind; }
        if ($this->searchString != '') { $currentQueryString['searchString'] = $this->searchString; }
        if ($this->pageRows != '' && $this->pageRows != '15') { $currentQueryString['pageRows'] = $this->pageRows; }
        if ($this->pageOrder != '' && $this->pageOrder != 'created_at') { $currentQueryString['pageOrder'] = $this->pageOrder; }
        if ($this->pagePeriod != '' && $this->pagePeriod != 'all') { $currentQueryString['pagePeriod'] = $this->pagePeriod; }
        if ($this->page != '' && $this->page != '1') { $currentQueryString['page'] = $this->page; }

        return view("livewire.board.{$this->board->skin}.write-list", [
            'notices' => $this->getNoticeWrites(),
            'writes' => $this->getWrites(),
            'currentQueryString' => $currentQueryString
        ]);
    }

    public function getWrites(): LengthAwarePaginator
    {
        $query = BoardWrite::where('table_id', $this->tableId)->where('is_delete', 0)->where('is_notice', 0);

        if (!empty($this->searchString)) {
            if ($this->searchKind !== ''){
                $query->where($this->searchKind, 'like', '%'.$this->searchString.'%');
            }else{
                $query->where(function ($query) {
                    $query->where('subject', 'like', '%'.$this->searchString.'%')
                        ->orWhere('content', 'like', '%'.$this->searchString.'%');
                });
            }
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

        if (!empty($this->category)) {
            $query->where('categories', $this->category);
        }

        if (empty($this->pageOrder)) $this->pageOrder = 'created_at';
        if ($this->pageOrder === 'rate') {
            $query->orderByRaw("(rate_up - rate_down) desc");
        }elseif ($this->pageOrder === 'comment') {
            $query->orderBy('comment_count', 'desc');
        }else{
            $query->orderBy($this->pageOrder, 'desc');
        }

        if ($this->board->skin === 'gallery') {
            $this->pageRows = 18;
        }else if ($this->board->skin === 'faq') {
            $this->pageRows = 1000;
        }
        if (empty($this->pageRows)) $this->pageRows = 15;

        return $query->orderBy('id', 'desc')->paginate($this->pageRows);
    }

    public function getNoticeWrites(): array|Collection|\Illuminate\Support\Collection
    {
        return BoardWrite::where('table_id', $this->tableId)->where('is_delete', 0)->where('is_notice', 1)->orderBy('id', 'desc')->limit(3)->get();
    }

    public function setCategory($category): void
    {
        $this->category = $category;
        $this->accordion_selected = 0;
    }

    public function setAccordionSelected($number): void
    {
        $this->accordion_selected = $number;
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchString', 'pageRows', 'pageOrder', 'pagePeriod', 'category'])) {
            $this->resetPage();
        }
    }

    public function updatedPage($page): void
    {
        $this->page = $page;
    }
}
