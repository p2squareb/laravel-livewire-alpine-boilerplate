<main>
    <div class="p-3 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="{{ route('admin.board.list') }}" wire:navigate class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">게시판 관리</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">게시판 수정</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">게시판 수정</h1>
            </div>

            <div class="p-4 my-7 bg-white border border-gray-200 rounded-md shadow-sm col-span-full dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <form wire:submit.prevent="updateBoard">
                    <div class="flex items-center mb-5">
                        <div class="flex flex-col">
                            <h3 class="text-lg font-semibold dark:text-white">게시판 사용 여부 </h3>
                        </div>
                        <label for="status" class="flex cursor-pointer">
                            <input type="checkbox" wire:model="status" id="status" class="sr-only peer" value="1" @if ($status == '1') checked @endif >
                            <div class="relative w-11 h-6 ml-10 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>
                    <div class="grid grid-cols-6 gap-x-12 gap-y-6">
                        <div class="col-span-6 sm:col-span-2">
                            <label for="table_id" class="inline-block sm:w-20 mb-2 text-sm font-medium text-gray-900 dark:text-white">게시판 ID</label>
                            <input wire:model="table_id" id="table_id" type="text" class="block w-full p-[7px] text-sm rounded-md bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-blue-500" placeholder="게시판 ID">
                            @error('table_id')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="table_name" class="inline-block sm:w-20 mb-2 text-sm font-medium text-gray-900 dark:text-white">게시판명</label>
                            <input wire:model="table_name" id="table_name" type="text" class="block w-full p-[7px] text-sm rounded-md bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-blue-500" placeholder="게시판명">
                            @error('table_name')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="skin" class="inline-block sm:w-20 mb-2 text-sm font-medium text-gray-900 dark:text-white">스킨</label>
                            <select id="skin" wire:model.live="skin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="">스킨 선택</option>
                                @foreach($skins as $key => $skin)
                                    <option value="{{ $skin }}">{{ $skin }}</option>
                                @endforeach
                            </select>
                            @error('skin')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="use_category-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">카테고리 기능</label>
                            <input wire:model="use_category" id="use_category-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                            <label for="use_category-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                            <input wire:model="use_category" id="use_category-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                            <label for="use_category-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용안함</label>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="category_list" class="inline-block sm:w-20 mb-2 text-sm font-medium text-gray-900 dark:text-white">카테고리 항목</label>
                            <input wire:model="category_list" id="category_list" type="text" class="block w-full p-[7px] text-sm rounded-md bg-gray-50 border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-blue-500" placeholder="카테고리명1,카테고리명2,카테고리명3...">
                            @error('category_list')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="use_comment-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">댓글 기능</label>
                            <input wire:model="use_comment" id="use_comment-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600" @if($this->skin === 'faq') disabled @endif>
                            <label for="use_comment-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                            <input wire:model="use_comment" id="use_comment-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                            <label for="use_comment-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용안함</label>
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="use_rate-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">추천 기능</label>
                            <input wire:model="use_rate" id="use_rate-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600" @if($this->skin === 'faq') disabled @endif>
                            <label for="use_rate-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                            <input wire:model="use_rate" id="use_rate-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                            <label for="use_rate-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용안함</label>
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <label for="use_report-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">신고 기능</label>
                            <input wire:model="use_report" id="use_report-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600" @if($this->skin === 'faq') disabled @endif>
                            <label for="use_report-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                            <input wire:model="use_report" id="use_report-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                            <label for="use_report-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용안함</label>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <label for="write_level-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">글쓰기 등급</label>
                            <input wire:model="write_level" id="write_level-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600" @if($this->skin === 'faq') disabled @endif>
                            <label for="write_level-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">회원</label>
                            <input wire:model="write_level" id="write_level-11" type="radio" value="11" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                            <label for="write_level-11" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">관리자</label>
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-full text-right pt-8 space-x-2">
                        <button type="button" @click="Livewire.navigate('{{ route('admin.board.list') }}')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">목록</button>
                        <button id="btnSave" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">저장</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @once <x-alert /> @endonce
</main>
