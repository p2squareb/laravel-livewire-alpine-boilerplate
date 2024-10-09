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
                            <a href="{{ route('mypage.report.list') }}" wire:navigate class="inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">신고내역</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.point.list') }}" wire:navigate class="active inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 focus:outline-none dark:bg-gray-700 dark:text-white">포인트</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.notification.list') }}" wire:navigate class="rounded-e-md inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">알림</a>
                        </li>
                    </ul>
                    <div class="flex flex-col mt-3">
                        <div class="overflow-x-auto rounded-md">
                            <div class="overflow-hidden shadow sm:rounded-md min-w-full" wire:loading.class.delay="opacity-50">
                                <div class="hidden lg:flex flex-row flex-nowrap justify-start py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                    <div class="w-[20%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">구분</div>
                                    <div class="w-[15%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">지급/차감</div>
                                    <div class="w-[15%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">금액</div>
                                    <div class="w-[20%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">지급/차감일</div>
                                    <div class="w-full font-medium text-sm text-center text-gray-500 dark:text-gray-400">사유</div>
                                </div>
                                @foreach($points as $key => $point)
                                    <div class="flex flex-row flex-nowrap justify-start py-3 {{ ($key % 2 === 0) ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                        <div class="hidden lg:flex w-[20%] text-sm items-center justify-center text-gray-900 dark:text-white">
                                            @if ($point->point_item === 'join')
                                                회원가입
                                            @elseif ($point->point_item === 'login')
                                                로그인
                                            @elseif ($point->point_item === 'write')
                                                게시글 작성
                                            @elseif ($point->point_item === 'write_comment')
                                                댓글 추가
                                            @elseif ($point->point_item === 'write_up')
                                                게시글 추천
                                            @elseif ($point->point_item === 'write_down')
                                                게시글 비추천
                                            @elseif ($point->point_item === 'comment')
                                                댓글 작성
                                            @elseif ($point->point_item === 'comment_up')
                                                댓글 추천
                                            @elseif ($point->point_item === 'comment_down')
                                                댓글 비추천
                                            @elseif ($point->point_item === 'admin')
                                                관리자 지금/차감
                                            @endif
                                        </div>
                                        <div class="hidden lg:flex w-[15%] items-center justify-center text-sm text-gray-900 dark:text-white">
                                            @if ($point->point_type === 'P')
                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-200 dark:text-green-900">지급</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-200 dark:text-red-900">차감</span>
                                            @endif
                                        </div>
                                        <div class="hidden lg:flex w-[15%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $point->amount }}pt
                                        </div>
                                        <div class="hidden lg:flex w-[20%] text-sm items-center justify-center text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ humanReadableDate($point->created_at, 3) }}
                                        </div>

                                        <div class="hidden lg:flex w-full items-center justify-center text-sm text-gray-900 dark:text-white ml-1 cursor-pointer">
                                            <div class="line-clamp-1 py-[2px] items-center">
                                                {{ $point->reason }}
                                            </div>
                                        </div>
                                        <div class="flex-row lg:hidden w-full items-center">
                                            <div class="flex items-center">
                                                <div class="items-center text-sm text-gray-900 dark:text-white cursor-pointer pl-1">
                                                    {{ $point->reason }}
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 space-x-3 justify-end">
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    @if ($point->point_item === 'join')
                                                        회원가입
                                                    @elseif ($point->point_item === 'login')
                                                        로그인
                                                    @elseif ($point->point_item === 'write')
                                                        게시글 작성
                                                    @elseif ($point->point_item === 'write_comment')
                                                        댓글 추가
                                                    @elseif ($point->point_item === 'write_up')
                                                        게시글 추천
                                                    @elseif ($point->point_item === 'write_down')
                                                        게시글 비추천
                                                    @elseif ($point->point_item === 'comment')
                                                        댓글 작성
                                                    @elseif ($point->point_item === 'comment_up')
                                                        댓글 추천
                                                    @elseif ($point->point_item === 'comment_down')
                                                        댓글 비추천
                                                    @elseif ($point->point_item === 'admin')
                                                        관리자 지금/차감
                                                    @endif
                                                </p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                    @if ($point->point_type === 'P')
                                                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-200 dark:text-green-900">지급</span>
                                                    @else
                                                        <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-200 dark:text-red-900">차감</span>
                                                    @endif
                                                </p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ $point->amount }}pt</p>
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ humanReadableDate($point->created_at, 3) }}</p>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{ $points->links('vendor.livewire.common') }}
            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>

