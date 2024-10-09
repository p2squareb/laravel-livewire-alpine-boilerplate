<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-1">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><a href="{{ route('write.list', ['tableId' => $board->table_id]) }}" wire:navigate>{{ $board->table_name }}</a></h1>
                    </div>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto rounded-md">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <form wire:submit.prevent="createWrite">
                                        <div class="grid grid-cols-6 gap-1">
                                            @if ($board->use_category === 1)
                                                <div class="col-span-6 md:col-span-2 pt-2 items-center">
                                                    <select id="categories" wire:model="categories" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                                        <option value="">카테고리 선택</option>
                                                        @php $category_list = explode(',', $board->category_list); @endphp
                                                        @foreach($category_list as $key => $category)
                                                            <option value="{{ $category }}">{{ $category }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
                                            @guest
                                                <div class="col-span-3 md:col-span-2">
                                                    <label for="writer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                                                    <input type="text" wire:model="writer" id="writer" class="text-sm shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-md focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="작성자명">
                                                    @error('writer')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                                                </div>
                                                <div class="col-span-3 md:col-span-2">
                                                    <label for="passwd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                                                    <input type="password" wire:model="passwd" id="passwd" class="text-sm shadow-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-md focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="비밀번호">
                                                    @error('passwd')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                                                </div>
                                            @endguest
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
                                        <div class="col-span-6 sm:col-full text-right mt-3 space-x-1">
                                            <button type="button" @click="Livewire.navigate('{{ route('write.list', ['tableId' => $board->table_id]) }}')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">목록</button>
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
        <div class="hidden xl:block col-span-full xl:col-auto">
            <livewire:board.write-side />
        </div>
    </div>
</main>

@push('scripts') <x-ckeditor id="content" btn="#btnSave" /> @endpush
