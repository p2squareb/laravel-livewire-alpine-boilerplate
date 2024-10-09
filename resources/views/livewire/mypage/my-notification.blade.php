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
                            <a href="{{ route('mypage.point.list') }}" wire:navigate class="inline-block w-full p-3 bg-white border-r border-gray-200 dark:border-gray-700 hover:text-gray-700 hover:bg-gray-50 focus:outline-none dark:hover:text-white dark:bg-gray-900 dark:hover:bg-gray-700">포인트</a>
                        </li>
                        <li class="w-full focus-within:z-10">
                            <a href="{{ route('mypage.notification.list') }}" wire:navigate class="active rounded-e-md inline-block w-full p-3 text-gray-900 bg-gray-100 border-r border-gray-200 dark:border-gray-700 focus:outline-none dark:bg-gray-700 dark:text-white">알림</a>
                        </li>
                    </ul>
                    <div class="flex flex-col mt-3">
                        <div class="overflow-x-auto rounded-md">
                            <div class="overflow-hidden shadow sm:rounded-md min-w-full" wire:loading.class.delay="opacity-50">
                                <div class="hidden lg:flex flex-row flex-nowrap justify-start py-3 bg-gray-50 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-700">
                                    <div class="w-full font-medium text-sm text-center text-gray-500 dark:text-gray-400">내용</div>
                                    <div class="w-[20%] font-medium text-sm text-center text-gray-500 dark:text-gray-400">알림일</div>
                                </div>
                                @foreach($notifications as $key => $notification)
                                    <div class="flex flex-row flex-nowrap justify-start py-3 {{ ($key % 2 === 0) ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                        <div @click="Livewire.navigate('{{ $notification->refer_url }}')" class="hidden lg:flex w-full items-center text-sm text-gray-900 dark:text-white ml-1 cursor-pointer">
                                            <div class="line-clamp-1 py-[2px] items-center">
                                                {{ $notification->message }}
                                            </div>
                                        </div>
                                        <div class="flex-row lg:hidden w-full items-center">
                                            <div class="flex items-center">
                                                <div @click="Livewire.navigate('{{ $notification->refer_url }}')" class="items-center text-sm text-gray-900 dark:text-white cursor-pointer px-1">
                                                    {{ $notification->message }}
                                                </div>
                                            </div>
                                            <div class="flex items-center mt-2 space-x-3 justify-end  px-1  ">
                                                <p class="inline-flex items-center text-xs text-gray-600 dark:text-gray-400">{{ humanReadableDate($notification->created_at, 3) }}</p>
                                            </div>
                                        </div>
                                        <div class="hidden lg:flex w-[15%] text-sm items-center justify-center text-gray-900 dark:text-white">{{ humanReadableDate($notification->created_at, 3) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                {{ $notifications->links('vendor.livewire.common') }}
            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>
