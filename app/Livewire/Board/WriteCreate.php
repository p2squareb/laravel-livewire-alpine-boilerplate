<?php

namespace App\Livewire\Board;

use App\Models\BoardWrite;
use App\Services\PointService;
use App\Traits\BoardConfig;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use function PHPUnit\Framework\isEmpty;

class WriteCreate extends Component
{
    use BoardConfig;
    use WithFileUploads;

    public $board;
    public $subject, $content, $writer, $passwd, $is_notice, $categories, $firstImageUrl;

    public function mount($tableId): void
    {
        $this->board = $this->getBoard($tableId);
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view("livewire.board.{$this->board->skin}.write-create");
    }

    public function createWrite(PointService $pointService): void
    {
        $this->validate();

        $insertData = [
            'board_id' => $this->board->id,
            'table_id' => $this->board->table_id,
            'subject' => $this->subject,
            'content' => $this->content,
            'ip' => request()->ip(),
        ];

        if (auth()->check()) {
            $insertData['user_id'] = auth()->user()->id;
            $insertData['writer'] = auth()->user()->nickname;
        }else{
            $insertData['writer'] = $this->writer;
            $insertData['password'] = Hash::make($this->passwd);
        }

        if ($this->board->use_category === 1) {
            $insertData['categories'] = $this->categories;
        }

        if (auth()->check() && auth()->user()->group_level >= 11) {
            $insertData['is_notice'] = (isEmpty($this->is_notice)) ? '0' : $this->is_notice;
        }

        $hasImage = containsImage($this->content);
        $insertData['has_image'] = $hasImage;
        if ($hasImage){
            $this->firstImageUrl = extractFirstImageUrl($this->content);
        }
        $insertData['list_file'] = $this->firstImageUrl;

        $hasVideo = containsVideo($this->content);
        $insertData['has_video'] = $hasVideo;

        $newWriteId = BoardWrite::insertGetId($insertData);
        $this->updateArticleCount($this->board->table_id, 'create');

        if (cache('config.point')->point->use_point_write == '1'){
            $pointService->savePoint('board_writes', $newWriteId, 'write', auth()->id(), auth()->id());
        }

        $this->redirectRoute('write.list', ['tableId' => $this->board->table_id], navigate: true);
    }

    protected function rules(): array
    {
        $rules = [
            'subject' => 'required',
            'content' => 'required',
        ];
        if (auth()->guest()) {
            $rules['writer'] = 'required';
            $rules['passwd'] = 'required';
        }
        return $rules;
    }

    protected function messages(): array
    {
        return [
            'subject.required' => '제목을 입력해주세요.',
            'content.required' => '내용을 입력해주세요.',
            'writer.required' => '작성자를 입력해주세요.',
            'passwd.required' => '비밀번호를 입력해주세요.',
        ];
    }
}
