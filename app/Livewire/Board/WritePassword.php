<?php

namespace App\Livewire\Board;

use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WritePassword extends Component
{
    use BoardConfig;

    public $board;
    public $writeId;
    public $passwd;
    public $access;

    public function mount($tableId, $writeId, $access): void
    {
        $this->board = $this->getBoard($tableId);
        $this->writeId = $writeId;
        $this->access = $access;
    }

    #[Layout('layouts.app')]
    public function render(): Factory|Application|View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.board.write-password');
    }

    public function checkPassword(): Redirector|RedirectResponse
    {
        $this->validate();

        $write = BoardWrite::where('id', $this->writeId)->first();

        if (Hash::check($this->passwd, $write->password)) {
            session()->flash(session()->getId() . 'write-' . $this->board->table_id . '-' . $this->writeId);
            return redirect(route('write.'.$this->access, ['tableId' => $this->board->table_id, 'writeId' => $this->writeId]));
        }else{
            throw ValidationException::withMessages([
                'auth-failed' => '비밀번호가 올바르지 않습니다.',
            ]);
        }
    }

    protected function rules(): array
    {
        return [
            'passwd' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'passwd.required' => '비밀번호를 입력해주세요.'
        ];
    }
}
