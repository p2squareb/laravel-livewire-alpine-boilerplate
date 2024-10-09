<?php

namespace App\Livewire\Admin\Inquiry;

use App\Models\InquiryCategory;
use App\Traits\Toastable;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class InquiryCategoryManage extends Component
{
    use Toastable;

    #[Validate('required', null, null, message: '카테고리를 입력해주세요.')]
    public $category;
    public $editCategory = [];

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.admin.inquiry.inquiry-category-manage');
    }

    #[Computed]
    protected function inquiryCategories(): Collection|array|\Illuminate\Support\Collection
    {
        $inquiryCategories =  InquiryCategory::all();
        foreach($inquiryCategories as $item) {
            $this->editCategory[$item->id] = $item->category;
        }
        return $inquiryCategories;
    }

    public function createInquiryCategory(): void
    {
        $this->validate();

        $insertData = [
            'category' => $this->category,
        ];

        try{
            InquiryCategory::create($insertData);
            $this->reset(['category']);
            $this->toastSuccess('정상적으로 문의유형이 등록되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('InquiryCategoryManage.createInquiryCategory : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function updateInquiryCategory(int $id): void
    {
        $this->validate([
            "editCategory.$id" => 'required|string|max:100',
        ]);

        $updateData = [
            'category' => $this->editCategory[$id],
        ];

        try{
            InquiryCategory::find($id)->update($updateData);
            $this->reset(['category']);
            $this->toastSuccess('정상적으로 문의유형이 수정되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('InquiryCategoryManage.updateInquiryCategory : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }

    public function deleteInquiryCategory(int $id): void
    {
        try{
            InquiryCategory::destroy($id);
            $this->toastSuccess('정상적으로 문의유형이 삭제되었습니다.');
        }catch (Exception $e) {
            Debugbar::error('InquiryCategoryManage.deleteInquiryCategory : ' . $e->getMessage());
            $this->dispatch('open-alert', type: 'error');
        }
    }
}
