<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><a href="{{ route('write.list', ['tableId' => $board->table_id]) }}" wire:navigate>{{ $board->table_name }}</a></h1>
                    </div>
                    <div class="items-center justify-between md:flex">
                        <div class="items-center md:flex md:space-x-3 mb-3 lg:mb-0">
                            <div class="flex items-center space-x-3">
                                <div class="relative w-full">
                                    <select id="pageOrder" wire:model.live="pageOrder" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                        <option value="created_at">최신순</option>
                                        <option value="hit">조회순</option>
                                        @if ($board->use_rate === 1))<option value="rate">추천순</option>@endif
                                        @if ($board->use_comment === 1))<option value="comment">댓글순</option>@endif
                                    </select>
                                </div>
                                <div class="relative w-full">
                                    <select id="pagePeriod" wire:model.live="pagePeriod" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                        <option value="all">전체</option>
                                        <option value="7">7일</option>
                                        <option value="30">30일</option>
                                        <option value="3m">3개월</option>
                                        <option value="6m">6개월</option>
                                        <option value="1y">1년</option>
                                    </select>
                                </div>
                                <div class="relative w-full">
                                    <select id="pageRows" wire:model.live="pageRows" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                        <option value="15">15개</option>
                                        <option value="30">30개</option>
                                        <option value="50">50개</option>
                                        <option value="100">100개</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                    <div class="flex flex-col mt-3">
                        <div class="overflow-x-auto">
                            <div class="overflow-hidden shadow sm:rounded-md min-w-full" wire:loading.class.delay="opacity-50">
                                @foreach($writes as $key => $write)
                                    <div class="sm:flex items-center mb-4 pb-4 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                                        <div class="flex relative justify-center items-start shrink-0 cursor-pointer rounded-md h-auto aspect-[2/1] overflow-hidden mr-2 sm:mr-3 mb-2 sm:mb-0">
                                            @if ($write->list_file != '')
                                                <img src="{{ $write->list_file }}" class="w-full sm:w-[180px] md:w-[240px]" alt="{{ $write->subject }}"/>
                                            @else
                                                <img src="/img/image-default.jpeg" class="w-full sm:w-[180px] md:w-[240px]" alt="{{ $write->subject }}"/>
                                            @endif
                                        </div>
                                        <div class="grow">
                                            <a href="{{ route('write.read', array_merge(['tableId' => $board->table_id, 'writeId' => $write->id], $currentQueryString)) }}" wire:navigate>
                                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1 line-clamp-2 sm:line-clamp-1">{{ $write->subject }}</h3>
                                            </a>
                                            <div id="clamped-text" class="text-sm text-gray-700 dark:text-gray-300 mb-2 line-clamp-2">{{ strip_tags($write->content) }}</div>
                                            <div class="flex flex-wrap justify-between items-center">
                                                <div class="flex flex-wrap items-center space-x-2 mr-2">
                                                    <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                        <svg class="w-[16px] h-[16px] text-gray-600 dark:text-gray-400 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $write->hit }}
                                                    </p>
                                                    @if ($board->use_rate === 1)
                                                        @if ($write->rate_up - $write->rate_down > 0)
                                                            <p class="inline-flex items-center text-sm text-blue-700 dark:text-blue-500">
                                                        @elseif ($write->rate_up - $write->rate_down < 0)
                                                            <p class="inline-flex items-center text-sm text-red-700 dark:text-red-600">
                                                        @else
                                                            <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                        @endif
                                                            <svg class="w-[16px] h-[16px] text-gray-600 dark:text-gray-400 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                                            </svg>
                                                            {{ $write->rate_up - $write->rate_down }}
                                                        </p>
                                                    @endif
                                                    @if ($board->use_comment === 1)
                                                        <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                            <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                                <path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd"/>
                                                                <path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd"/>
                                                            </svg>{{ $write->comment_count }}
                                                        </p>
                                                    @endif
                                                    <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                        {{ humanReadableDate($write->created_at, 1) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
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

