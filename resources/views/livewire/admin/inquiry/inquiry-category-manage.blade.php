<div class=" w-full bg-white rounded-md shadow dark:bg-gray-800 lg:px-2">
    <div class="flex items-start justify-between p-3 mt-3">
        <h3 class="text-lg font-semibold dark:text-white">문의 유형 관리</h3>
        <button type="button" @click="$dispatch('close-modal');" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    <div class="grid grid-cols-12 gap-2 px-3 mb-2">
        <div class="col-span-9 items-center">
            <input type="text" id="category" wire:model="category" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="문의유형을 입력해주세요.">
            @error('category')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
        </div>
        <div class="col-span-3 space-x-1 items-center text-right">
            <button type="button" wire:click.prevent="createInquiryCategory" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>등록
            </button>
        </div>
    </div>
    @foreach($this->inquiryCategories() as $key => $category)
        <div class="grid grid-cols-12 gap-2 px-3 mb-2" wire:key="{{ $key }}">
            <div class="col-span-9 items-center">
                <input type="text" id="editCategory" wire:model.defer="editCategory.{{ $category->id }}" value="{{ $category->category }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="문의유형을 입력해주세요.">
                @error('editCategory')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div class="col-span-3 space-x-1 items-center text-right">
                <button type="button" wire:click.prevent="updateInquiryCategory({{ $category->id }})" class="inline-flex text-white bg-teal-700 hover:bg-teal-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-teal-600 dark:hover:bg-teal-700">
                    <svg class="w-4 h-4 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>수정
                </button>
                <button type="button" wire:click.prevent="deleteInquiryCategory({{ $category->id }})" class="inline-flex text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">
                    <svg class="w-4 h-4 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>삭제
                </button>
            </div>
        </div>
    @endforeach
    <div class="mb-8"></div>
</div>
