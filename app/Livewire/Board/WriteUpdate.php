<?php

namespace App\Livewire\Board;

use App\Models\BoardWrite;
use App\Traits\BoardConfig;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;
use function PHPUnit\Framework\isEmpty;

class WriteUpdate extends Component
{
    use BoardConfig;

    public $board, $writeId;
    public $subject, $content, $is_notice, $categories, $listFile, $firstImageUrl;

    public function mount($tableId, $writeId): void
    {
        $this->board = $this->getBoard($tableId);
        $this->writeId = $writeId;
    }

    #[Layout('layouts.app')]
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $this->writeData();
        return view("livewire.board.{$this->board->skin}.write-update");
    }

    public function writeData(): void
    {
        $write = BoardWrite::where('id', $this->writeId)->first();

        $this->subject = $write->subject;
        if (!empty($write->content)) {
            $this->content = $write->content;
        }
        $this->is_notice = $write->is_notice;
        $this->categories = $write->categories;
        $this->listFile = $write->list_file;
    }

    public function updateWrite(): void
    {
        $this->validate();

        $updateData = [
            'subject' => $this->subject,
            'content' => $this->content,
            'ip' => request()->ip(),
        ];

        if ($this->board->use_category === 1) {
            $updateData['categories'] = $this->categories;
        }

        if (auth()->check() && auth()->user()->group_level >= 11) {
            $updateData['is_notice'] = (isEmpty($this->is_notice)) ? '0' : $this->is_notice;
        }

        $hasImage = containsImage($this->content);
        $updateData['has_image'] = $hasImage;

        if ($hasImage){
            $this->firstImageUrl = extractFirstImageUrl($this->content);
            if (!is_null($this->listFile) && $this->listFile != $this->firstImageUrl){
                $updateData['list_file'] = $this->firstImageUrl;
            }
        }

        $hasVideo = containsVideo($this->content);
        $updateData['has_video'] = $hasVideo;

        BoardWrite::where('id', $this->writeId)->update($updateData);

        $this->redirectRoute('write.read', ['tableId' => $this->board->table_id, 'writeId' => $this->writeId], navigate: true);
    }

    protected function rules(): array
    {
        return [
            'subject' => 'required',
            'content' => 'required',
        ];
    }

    protected function messages(): array
    {
        return [
            'subject.required' => '제목을 입력해주세요.',
            'content.required' => '내용을 입력해주세요.',
        ];
    }
}
