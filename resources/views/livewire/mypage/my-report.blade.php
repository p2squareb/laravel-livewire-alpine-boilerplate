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
                            <a href="{{ route('mypage.rate.list') }}" wire:navigate class="inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">추천/비추천</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.report.list') }}" wire:navigate class="active inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 focus:outline-none dark:bg-gray-700 dark:text-white">신고내역</a>
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
                                    <div class="w-[15%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">사유</div>
                                    <div class="w-full font-medium text-sm text-center text-gray-500 dark:text-gray-400">제목/내용</div>
                                    <div class="w-[20%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">작성자</div>
                                    <div class="w-[13%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">신고일</div>
                                    <div class="w-[13%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">처리상태</div>
                                </div>
                                @foreach($reportList as $key => $report)
                                    <div class="flex flex-row flex-nowrap justify-start py-3 {{ ($key % 2 === 0) ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                        <div class="hidden lg:flex w-[15%] text-sm items-center justify-center text-gray-900 dark:text-white">{{ $report->field }}</div>
                                        <div @if ($report->is_delete === 0) @click="Livewire.navigate('{{ route('write.read', ['tableId' => $report->table_id, 'writeId' => $report->write_id]) }}')" @endif class="hidden lg:flex w-full items-center text-sm text-gray-900 dark:text-white ml-1 cursor-pointer">
                                            <div class="line-clamp-1 py-[2px] items-center">
                                                {{ $report->title }}
                                            </div>
                                        </div>

                                        <div class="flex-row lg:hidden w-full items-center">
                                            <div class="flex items-center">
                                                <div @if ($report->is_delete === 0) @click="Livewire.navigate('{{ route('write.read', ['tableId' => $report->table_id, 'writeId' => $report->write_id]) }}')" @endif class="items-center text-sm text-gray-900 dark:text-white cursor-pointer">
                                                    {{ $report->title }}
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 space-x-3 justify-end">
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ $report->field }}</p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    @if ($report->profile_photo_path)
                                                        <img class="w-4 h-4 rounded-full" src="/storage/profiles/{{ $report->profile_photo_path }}" alt="{{ $report->writer }}'s avatar">
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                        </svg>
                                                    @endif
                                                    <span class="ml-1">{{ $report->writer }}</span>
                                                </p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ humanReadableDate($report->created_at, 1) }}</p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    @if ($report->status === 0)
                                                        처리중
                                                    @else
                                                        @if ($report->is_delete === 1)
                                                            게시물 삭제됨
                                                        @else
                                                            반려
                                                        @endif
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="hidden lg:flex w-[20%] items-center justify-center text-sm text-gray-900 dark:text-white">
                                            @if ($report->profile_photo_path)
                                                <img class="w-5 h-5 rounded-full" src="/storage/profiles/{{ $report->profile_photo_path }}" alt="{{ $report->writer }}'s avatar">
                                            @else
                                                <svg class="w-5 h-5 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                </svg>
                                            @endif
                                            <span class="ml-1">{{ $report->writer }}</span>
                                        </div>
                                        <div class="hidden lg:flex w-[13%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($report->created_at, 1) }}</div>
                                        <div class="hidden lg:flex w-[13%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">
                                            @if ($report->status === 0)
                                                처리중
                                            @else
                                                @if ($report->is_delete === 1)
                                                    삭제
                                                @else
                                                    반려
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{ $reportList->links('vendor.livewire.common') }}
            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>

