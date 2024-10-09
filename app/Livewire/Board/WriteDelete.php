<?php

namespace App\Livewire\Board;

use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Component;

class WriteDelete extends Component
{
    use BoardConfig;

    public $board;
    public $writeId;
    public $passCheck = false;
    public $passwd;

    public function mount($tableId, $writeId): void
    {
        $this->board = $this->getBoard($tableId);
        $this->writeId = $writeId;
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $write = BoardWrite::where('id', $this->writeId)->first();

        if (is_null($write->user_id)) {
            $this->passCheck = false;
        }else{
            if (auth()->user()->group_level >= 11 || auth()->check() && $write->user_id == auth()->user()->id) {
                $this->passCheck = true;
            }else{
                abort(403);
            }
        }

        return view('livewire.board.write-delete', ['passCheck' => $this->passCheck]);
    }

    public function deleteWrite(): void
    {
        BoardWrite::where('id', $this->writeId)->update([
            'is_delete' => 1,
            'deleted_at' => Carbon::now()
        ]);

        $this->dispatch('open-alert', type: 'success', next: 'redirect', link: route('write.list', ['tableId' => $this->board->table_id]), message: '게시물이 삭제되었습니다.');
    }

    public function checkPassword(): void
    {
        $this->validate();

        $write = BoardWrite::where('id', $this->writeId)->first();

        if (Hash::check($this->passwd, $write->password)) {
            $this->deleteWrite();
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
