<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white">활동기록</h1>
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
                            <a href="{{ route('mypage.comment.list') }}" wire:navigate class="inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">댓글</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.rate.list') }}" wire:navigate class="active inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 focus:outline-none dark:bg-gray-700 dark:text-white">추천/비추천</a>
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
                                    <div class="w-[8%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">구분</div>
                                    <div class="w-full font-medium text-sm text-center text-gray-500 dark:text-gray-400">제목/내용</div>
                                    <div class="w-[7%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">추천</div>
                                    <div class="w-[11%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">등록일</div>
                                </div>
                                @foreach($rateList as $key => $rate)
                                    <div class="flex flex-row flex-nowrap justify-start py-3 {{ ($key % 2 === 0) ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                        <div class="hidden lg:flex w-[8%] text-sm items-center justify-center text-gray-900 dark:text-white">{{ $rate->gubun }}</div>
                                        <div @if ($rate->is_delete === 0) @click="Livewire.navigate('{{ route('write.read', ['tableId' => $rate->table_id, 'writeId' => $rate->target_id]) }}')" @endif class="hidden lg:flex w-full items-center text-sm text-gray-900 dark:text-white ml-1 cursor-pointer">
                                            <div class="line-clamp-1 py-[2px] items-center">
                                                @if ($rate->is_delete === 1) <b>[삭제됨]</b @endif {{ $rate->title }}
                                            </div>
                                        </div>

                                        <div class="flex-row lg:hidden w-full items-center">
                                            <div class="flex items-center">
                                                <div @if ($rate->is_delete === 0) @click="Livewire.navigate('{{ route('write.read', ['tableId' => $rate->table_id, 'writeId' => $rate->target_id]) }}')" @endif class="items-center text-sm text-gray-900 dark:text-white cursor-pointer">
                                                    @if ($rate->is_delete === 1) <b>[삭제됨]</b @endif {{ $rate->title }}
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 space-x-3 justify-end">
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ $rate->gubun }}</p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    @if ($rate->rate === 'up')
                                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-red-600 dark:text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd"/>
                                                        </svg>
                                                    @endif
                                                </p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ humanReadableDate($rate->created_at, 1) }}</p>
                                            </div>
                                        </div>

                                        <div class="hidden lg:flex w-[7%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">
                                            @if ($rate->rate === 'up')
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5 text-red-600 dark:text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="hidden lg:flex w-[11%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($rate->created_at, 1) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{ $rateList->links('vendor.livewire.common') }}
            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>

