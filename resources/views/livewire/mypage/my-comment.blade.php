<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">활동기록</h1>
                    </div>
                    <div class="items-center justify-between md:flex">
                        <div class="items-center md:flex md:space-x-3 mb-3 lg:mb-0">
                            <div class="flex items-center space-x-3">
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
                                    <input type="search" wire:model="searchString" wire:keydown.enter="listComments" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="내용 검색"/>
                                    <button type="button" wire:click.prevent="listComments" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                        </svg>
                                        <span class="sr-only">Search</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sm:hidden mt-3">
                        <select id="classify" wire:model.live="classify" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                            <option value="write">게시글</option>
                            <option value="comment">댓글</option>
                            <option value="rate">추천/비추천</option>
                            <option value="report">신고내역</option>
                            <option value="point">포인트</option>
                            <option value="notification">알림</option>
                        </select>
                    </div>
                    <ul class="hidden mt-3 text-sm font-medium text-center text-gray-500 rounded-md shadow sm:flex dark:divide-gray-700 dark:text-gray-400">
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.write.list') }}" wire:navigate class="rounded-s-md inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">게시글</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.comment.list') }}" wire:navigate class="active inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 focus:outline-none dark:bg-gray-700 dark:text-white">댓글</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.rate.list') }}" wire:navigate class="inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">추천/비추천</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.report.list') }}" wire:navigate class="inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">신고내역</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.point.list') }}" wire:navigate class="inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">포인트</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.notification.list') }}" wire:navigate class="rounded-e-md inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">알림</a>
                        </li>
                    </ul>
                    <div class="flex flex-col mt-3">
                        <div class="overflow-x-auto rounded-md">
                            <div class="overflow-hidden shadow sm:rounded-md min-w-full" wire:loading.class.delay="opacity-50">
                                <div class="hidden lg:flex flex-row flex-nowrap justify-start py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                    <div class="w-[19%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">구분</div>
                                    <div class="w-full font-medium text-sm text-center text-gray-500 dark:text-gray-400">내용</div>
                                    <div class="w-[6%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">추천</div>
                                    <div class="w-[11%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">작성일</div>
                                </div>

                                @foreach($commentList as $key => $comment)
                                    <div class="flex flex-row flex-nowrap justify-start py-3 {{ ($key % 2 === 0) ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                        <div class="hidden lg:flex w-[19%] items-center justify-center text-sm text-gray-900 dark:text-white">
                                            {{ $comment->board->table_name }}
                                        </div>
                                        <div @click="Livewire.navigate('{{ route('write.read', ['tableId' => $comment->table_id, 'writeId' => $comment->write_id]) }}')" class="hidden lg:flex w-full items-center text-sm text-gray-900 dark:text-white ml-1 cursor-pointer">
                                            <div class="line-clamp-1 py-[2px] items-center">
                                                {{ $comment->comment }}
                                            </div>
                                        </div>

                                        <div class="flex-row lg:hidden w-full items-center">
                                            <div class="flex items-center">
                                                <div @click="Livewire.navigate('{{ route('write.read', ['tableId' => $comment->table_id, 'writeId' => $comment->write_id]) }}')" class="items-center text-sm text-gray-900 dark:text-white cursor-pointer">
                                                    {{ $comment->comment }}
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 space-x-3 justify-end">
                                                @if ($comment->board->use_rate === 1)
                                                    @if ($comment->rate_up - $comment->rate_down > 0)
                                                        <p class="inline-flex items-center text-xs text-blue-700 dark:text-blue-500">
                                                    @elseif ($comment->rate_up - $comment->rate_down < 0)
                                                        <p class="inline-flex items-center text-xs text-red-700 dark:text-red-600">
                                                    @else
                                                        <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    @endif
                                                        <svg class="w-[16px] h-[16px] text-gray-600 dark:text-gray-400 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                                        </svg>
                                                    {{ formatNumberWithK($comment->rate_up - $comment->rate_down) }}
                                                    </p>
                                                @else
                                                    <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">-</p>
                                                @endif
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ humanReadableDate($comment->created_at, 2) }}</p>
                                            </div>
                                        </div>
                                        @if ($comment->board->use_rate === 1)
                                            @if ($comment->rate_up - $comment->rate_down > 0)
                                                <div class="hidden lg:flex w-[6%] text-sm items-center justify-center whitespace-nowrap text-blue-700 dark:text-blue-500">{{ formatNumberWithK($comment->rate_up - $comment->rate_down) }}</div>
                                            @elseif ($comment->rate_up - $comment->rate_down < 0)
                                                <div class="hidden lg:flex w-[6%] text-sm items-center justify-center whitespace-nowrap text-red-700 dark:text-red-600">{{ formatNumberWithK($comment->rate_up - $comment->rate_down) }}</div>
                                            @else
                                                <div class="hidden lg:flex w-[6%] text-sm items-center justify-center whitespace-nowrap text-gray-900 dark:text-white">{{ formatNumberWithK($comment->rate_up - $comment->rate_down) }}</div>
                                            @endif
                                        @else
                                            <div class="hidden lg:flex w-[6%] text-sm items-center justify-center text-gray-900 dark:text-white">-</div>
                                        @endif
                                        <div class="hidden lg:flex w-[11%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($comment->created_at, 2) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{ $commentList->links('vendor.livewire.common') }}
            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>

