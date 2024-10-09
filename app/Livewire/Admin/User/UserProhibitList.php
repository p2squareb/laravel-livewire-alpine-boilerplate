<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserProhibit;
use App\Traits\Toastable;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class UserProhibitList extends Component
{
    use Toastable;
    use WithPagination;

    public $status = '', $pageRows = 15, $searchKind, $searchString;

    #[Layout('layouts.admin')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.user.user-prohibit-list', [
            'prohibits' => $this->prohibitUsers(),
        ]);
    }

    public function prohibitUsers(): LengthAwarePaginator
    {
        $query = UserProhibit::query();

        if ($this->status !== ''){
            $query->where('gubun', $this->status);
        }

        if ($this->searchKind !== null && $this->searchKind !== '' && $this->searchString !== null && $this->searchString !== '') {
            $query->where($this->searchKind, 'like', '%'. $this->searchString. '%');
        }

        return $query->orderBy('id', 'desc')->paginate($this->pageRows)->onEachSide(2);
    }

    public function clearProhibit($id, $user_id): void
    {
        UserProhibit::where('id', $id)->update([
            'gubun' => 0,
        ]);

        User::where('id', $user_id)->update([
            'status' => 1,
        ]);
    }

    public function updated($propertyName): void
    {
        if (in_array($propertyName, ['searchKind', 'searchString', 'pageRows', 'status'])) {
            $this->resetPage();
        }
    }
}
