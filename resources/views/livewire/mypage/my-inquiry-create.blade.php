<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-1">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">1:1 문의 등록</h1>
                    </div>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto rounded-md">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <form wire:submit.prevent="createInquiry">
                                        <div class="grid grid-cols-6 gap-1">
                                            <div class="col-span-6 md:col-span-2 pt-2 items-center">
                                                <select id="categories" wire:model="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                                    <option value="">카테고리 선택</option>
                                                    @foreach($inquiryCategories as $key => $category)
                                                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                                                    @endforeach
                                                </select>
                                                @error('categories')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                                            </div>
                                            <div class="col-span-6">
                                                <label for="subject" class="block mb-2 font-medium text-gray-900 dark:text-white"></label>
                                                <input type="text" wire:model="subject" id="subject" class="text-sm shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-md focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="제목을 입력해주세요.">
                                                @error('subject')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                                            </div>
                                            <div class="col-span-6" wire:ignore>
                                                <label for="content" class="block mb-2 font-medium text-gray-900 dark:text-white"></label>
                                                <textarea wire:model="content" id="content" class="text-sm p-[7px] w-full text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="내용을 입력해주세요."></textarea>
                                                @error('content')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                                            </div>
                                        </div>
                                        <div class="col-span-6 sm:col-full text-right mt-3 space-x-2">
                                            <button type="button" @click="Livewire.navigate('{{ route('mypage.inquiry.list') }}')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">목록</button>
                                            <button id="btnSave" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">저장</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>
    @once <x-alert /> @endonce
</main>

@push('scripts') <x-ckeditor id="content" btn="#btnSave" /> @endpush
