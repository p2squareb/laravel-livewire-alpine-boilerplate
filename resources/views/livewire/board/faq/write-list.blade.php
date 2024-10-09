<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><a href="{{ route('write.list', ['tableId' => $board->table_id]) }}" wire:navigate>{{ $board->table_name }}</a></h1>
                    </div>
                    <div class="items-center justify-end md:flex">
                        <div class="items-center md:flex md:space-x-3">
                            <div class="flex items-center">
                                <div class="relative w-full">
                                    <input type="search" wire:model="searchString" wire:keydown.enter="search" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="제목+내용 검색"/>
                                    <button type="button" wire:click.prevent="search" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                            @if ($isWrite)
                                <div class="hidden md:flex items-center">
                                    <div class="relative w-full">
                                        <button type="button" @click="Livewire.navigate('{{ route('write.create', ['tableId' => $board->table_id]) }}')" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                                            <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>글쓰기
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($board->use_category === 1)
                        @php
                            $categories = explode(',', $board->category_list);
                            $lastCategoryKey = count($categories) - 1;
                        @endphp
                        <div class="sm:hidden mt-3">
                            <label for="category" class="sr-only">Select Category</label>
                            <select id="category" wire:model.live="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="">전체</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <ul class="hidden mt-3 text-sm font-medium text-center text-gray-500 rounded-md shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                            <li class="w-full focus-within:z-10">
                                @if ($category == '')
                                    <button class="active rounded-s-md inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 focus:outline-none dark:bg-gray-700 dark:text-white">전체</button>
                                @else
                                    <button wire:click.prevent="setCategory('')" class="rounded-s-md inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">전체</button>
                                @endif
                            </li>
                            @foreach($categories as $key => $value)
                                <li class="w-full focus-within:z-10">
                                    @if ($category === $value)
                                        <button class="active @if ($lastCategoryKey === $key) rounded-e-md @endif inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-s-md active focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page">{{ $value }}</button>
                                    @else
                                        <button wire:click.prevent="setCategory('{{ $value }}')" class="@if ($lastCategoryKey === $key) rounded-e-md @endif inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700" aria-current="page">{{ $value }}</button>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div x-data="{ accordion_selected: @entangle('accordion_selected') }" class="mt-3" wire:loading.class.delay="opacity-50">
                        @php $lastKey = count($writes) - 1; @endphp
                        @foreach($writes as $key => $write)
                            <h2>
                                <button type="button" wire:click.prevent="setAccordionSelected({{ $key }})"
                                        class="flex items-center justify-between w-full p-3.5 font-medium rtl:text-right border
                                        @if($key === 0) rounded-t-md @else @endif
                                        @if ($lastKey > $key) border-b-0 @endif
                                        border-gray-200 dark:border-gray-700 bg-blue-100 dark:bg-gray-800 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3
                                        @if ($accordion_selected === $key) text-blue-600 dark:text-white @else text-gray-700 dark:text-gray-400 @endif">
                                    <span class="text-sm text-left">{{ $write->subject }}</span>
                                    <div class="flex items-center">
                                        <svg class="w-2.5 h-2.5 shrink-0 @if ($accordion_selected !== $key) rotate-180 @endif" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                        </svg>
                                        @if ($isWrite)
                                        <a href="{{ route('write.read', array_merge(['tableId' => $board->table_id, 'writeId' => $write->id], $currentQueryString)) }}" wire:navigate>
                                            <svg class="w-4 h-4 ml-2 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z"></path>
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                                            </svg>
                                        </a>
                                        @endif
                                    </div>
                                </button>
                            </h2>
                            <div x-show="accordion_selected === {{ $key }}">
                                <div class="p-3.5 border @if($key === 0) border-b-0 @endif @if ($lastKey === $key) border-t-0 @endif border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                    <div class="text-sm text-gray-700 dark:text-gray-300">{!! $write->content !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $writes->links('vendor.livewire.common') }}
            </div>
            <div class="fixed lg:hidden bottom-0 right-0 pr-4 pb-5">
                <button @click="Livewire.navigate('{{ route('write.create', ['tableId' => $board->table_id]) }}')" class="flex items-center justify-center ml-auto text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m13.835 7.578-.005.007-7.137 7.137 2.139 2.138 7.143-7.142-2.14-2.14Zm-10.696 3.59 2.139 2.14 7.138-7.137.007-.005-2.141-2.141-7.143 7.143Zm1.433 4.261L2 12.852.051 18.684a1 1 0 0 0 1.265 1.264L7.147 18l-2.575-2.571Zm14.249-14.25a4.03 4.03 0 0 0-5.693 0L11.7 2.611 17.389 8.3l1.432-1.432a4.029 4.029 0 0 0 0-5.689Z"/>
                    </svg>
                    <span class="sr-only">New Post</span>
                </button>
            </div>
        </div>

        <div class="hidden xl:block col-span-full xl:col-auto">
            <livewire:board.write-side />
        </div>

    </div>
</main>

