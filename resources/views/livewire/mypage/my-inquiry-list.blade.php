<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><a href="{{ route('mypage.inquiry.list') }}" wire:navigate>1:1 문의내역</a></h1>
                    </div>
                    <div class="items-center justify-between md:flex">
                        <div class="items-center md:flex md:space-x-3 mb-3 lg:mb-0">
                            <div class="flex items-center space-x-3">
                                <div class="relative w-full">
                                    <select id="inquiryStatus" wire:model.live="inquiryStatus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                        <option value="">전체</option>
                                        <option value="0">미답변</option>
                                        <option value="1">완료</option>
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
                                    <input type="search" wire:model="searchString" wire:keydown.enter="inquiries" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="제목+내용 검색"/>
                                    <button type="button" wire:click.prevent="inquiries" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                            <div class="hidden md:flex items-center">
                                <div class="relative w-full">
                                    <button type="button" @click="Livewire.navigate('{{ route('mypage.inquiry.create') }}')" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>문의하기
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:hidden mt-3">
                        <label for="category" class="sr-only">Select Category</label>
                        <select id="category" wire:model.live="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                            <option value="">전체</option>
                            @foreach($inquiryCategories as $key => $value)
                                <option value="{{ $value->category }}">{{ $value->category }}</option>
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
                        @foreach($inquiryCategories as $key => $value)
                            <li class="w-full focus-within:z-10">
                                @if ($category === $value->category)
                                    <button class="active @if ($lastCategoryKey === $key) rounded-e-md @endif inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 rounded-s-md active focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page">{{ $value->category }}</button>
                                @else
                                    <button wire:click.prevent="setCategory('{{ $value->category }}')" class="@if ($lastCategoryKey === $key) rounded-e-md @endif inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700" aria-current="page">{{ $value->category }}</button>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div class="flex flex-col mt-3">
                        <div class="overflow-x-auto rounded-md">
                            <div class="overflow-hidden shadow sm:rounded-md min-w-full" wire:loading.class.delay="opacity-50">
                                <div class="hidden lg:flex flex-row flex-nowrap justify-start py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                    <div class="w-[19%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">문의유형</div>
                                    <div class="w-full font-medium text-sm text-center text-gray-500 dark:text-gray-400">제목</div>
                                    <div class="w-[11%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">답변상태</div>
                                    <div class="w-[15%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">작성일</div>
                                </div>
                                @foreach($inquiries as $key => $inquiry)
                                    <div class="flex flex-row flex-nowrap justify-start py-3 {{ ($key % 2 === 0) ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                        <div class="hidden lg:flex w-[19%] items-center justify-center text-sm text-gray-900 dark:text-white whitespace-nowrap">
                                            <div class="ml-1 text-gray-500 dark:text-gray-400">
                                                <div class="text-gray-900 dark:text-white">{{ $inquiry->categories }}</div>
                                            </div>
                                        </div>
                                        <div @click="Livewire.navigate('{{ route('mypage.inquiry.read', array_merge(['inquiryId' => $inquiry->id], $currentQueryString)) }}')" class="hidden lg:flex w-full items-center text-sm text-gray-900 truncate dark:text-white cursor-pointer">
                                            {{ $inquiry->subject }}
                                        </div>
                                        <div class="flex-row lg:hidden w-full items-center mx-1">
                                            <div class="flex items-center">
                                                <div @click="Livewire.navigate('{{ route('mypage.inquiry.read', array_merge(['inquiryId' => $inquiry->id], $currentQueryString)) }}')" class="inline-flex items-center text-sm text-gray-900 dark:text-white cursor-pointer">
                                                    {{ $inquiry->subject }}
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 space-x-3 justify-end">
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    {{ $inquiry->categories }}
                                                </p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    {{ ($inquiry->status === 1) ? '답변완료' : '미답변' }}
                                                </p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ humanReadableDate($inquiry->created_at, 1) }}</p>
                                            </div>
                                        </div>
                                        <div class="hidden lg:flex w-[11%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">{{ ($inquiry->status === 1) ? '답변완료' : '미답변' }}</div>
                                        <div class="hidden lg:flex w-[15%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($inquiry->created_at, 1) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{ $inquiries->links('vendor.livewire.common') }}
            </div>
            <div class="fixed lg:hidden bottom-0 right-0 pr-4 pb-5">
                <button @click="Livewire.navigate('{{ route('mypage.inquiry.create') }}')" class="flex items-center justify-center ml-auto text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m13.835 7.578-.005.007-7.137 7.137 2.139 2.138 7.143-7.142-2.14-2.14Zm-10.696 3.59 2.139 2.14 7.138-7.137.007-.005-2.141-2.141-7.143 7.143Zm1.433 4.261L2 12.852.051 18.684a1 1 0 0 0 1.265 1.264L7.147 18l-2.575-2.571Zm14.249-14.25a4.03 4.03 0 0 0-5.693 0L11.7 2.611 17.389 8.3l1.432-1.432a4.029 4.029 0 0 0 0-5.689Z"/>
                    </svg>
                    <span class="sr-only">New Post</span>
                </button>
            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>

