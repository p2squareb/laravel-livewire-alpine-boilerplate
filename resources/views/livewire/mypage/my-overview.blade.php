<main>
    <div class="grid grid-cols-1 px-3 xl:px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-3">
                <div class="p-3 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                    <div class="items-center flex space-x-4">
                        @if (auth()->user()->profile_photo_path)
                            <img src="/storage/profiles/{{ auth()->user()->profile_photo_path }}" class="rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" alt="{{ auth()->user()->nickname }}">
                        @else
                            <label for="profile" class="flex flex-col items-center justify-center w-28 h-28 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-20 h-20 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                </div>
                            </label>
                        @endif
                        <div class="">
                            <h3 class="flex items-center mb-1 text-base font-bold text-gray-900 dark:text-white">
                                {{ auth()->user()->nickname }}
                                <a href="{{ route('profile.show') }}">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                    </svg>
                                </a>
                            </h3>
                            <div class="mb-1 text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</div>
                            <div class="mb-1 text-sm text-gray-500 dark:text-gray-400">Member Since {{ str_replace('-', '.', substr(auth()->user()->created_at, 0, 10)) }}</div>
                            <div class="flex items-center space-x-4">
                                @if (auth()->user()->profile_photo_path)
                                    <button wire:click="deleteProfileImage" type="button" class="inline-flex items-center py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        이미지 삭제
                                    </button>
                                @else
                                    <button type="button" onclick="document.getElementById('profile').click()" class="inline-flex items-center px-3 py-[7px] text-sm font-medium text-center text-white rounded-md bg-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                                        <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>
                                        이미지 업로드
                                    </button>
                                @endif
                                <input wire:model="profile" id="profile" accept="image/*" type="file" class="hidden" />
                            </div>
                            @error('profile')<div class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flow-root">
                        <div @click="Livewire.navigate('{{ route('mypage.write.list') }}')" class="flex justify-between cursor-pointer mb-3">
                            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">활동기록</h1>
                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="grid grid-cols-6 gap-3">
                            <div class="col-span-3">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="ml-2">게시물 : {{ number_format($activeCount['writesCount']) }}건</p>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    <svg class="w-[18px] h-[18px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="ml-2">댓글 : {{ number_format($activeCount['commentsCount']) }}건</p>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="ml-2">{{ number_format($activeCount['rateUpCount']) }}건</p>
                                    <svg class="w-4 h-4 ml-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd"/>
                                    </svg>
                                    <p class="ml-2">{{ number_format($activeCount['rateDownCount']) }}건</p>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                        <g transform="translate(0,24) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                                            <path d="M110 220 c0 -11 5 -20 10 -20 6 0 10 9 10 20 0 11 -4 20 -10 20 -5 0 -10 -9 -10 -20z"></path>
                                            <path d="M50 212 c0 -12 19 -26 26 -19 2 2 -2 10 -11 17 -9 8 -15 8 -15 2z"></path>
                                            <path d="M170 205 c-8 -9 -8 -15 -2 -15 12 0 26 19 19 26 -2 2 -10 -2 -17 -11z"></path>
                                            <path d="M70 160 c-15 -15 -20 -33 -20 -70 l0 -50 70 0 70 0 0 50 c0 59 -24 90 -70 90 -17 0 -39 -9 -50 -20z"></path>
                                            <path d="M15 160 c3 -5 11 -10 16 -10 6 0 7 5 4 10 -3 6 -11 10 -16 10 -6 0 -7 -4 -4 -10z"></path>
                                            <path d="M205 160 c-3 -5 -2 -10 4 -10 5 0 13 5 16 10 3 6 2 10 -4 10 -5 0 -13 -4 -16 -10z"></path>
                                            <path d="M30 15 c0 -12 17 -15 90 -15 73 0 90 3 90 15 0 12 -17 15 -90 15 -73 0 -90 -3 -90 -15z"></path>
                                        </g>
                                    </svg>
                                    <p class="ml-2">신고 : {{ number_format($activeCount['reportsCount']) }}건</p>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    P<p class="ml-3.5">포인트 : {{ number_format($activeCount['reportsCount']) }}건</p>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                                    <p class="ml-2">알림 : {{ number_format($activeCount['reportsCount']) }}건</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flow-root">
                        <div @click="Livewire.navigate('{{ route('mypage.login-record.list') }}')" class="flex justify-between cursor-pointer mb-3">
                            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">로그인 기록</h1>
                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="grid grid-cols-6 gap-3">
                            <div class="col-span-full sm:col-span-4">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    최근 접속일 : {{ str_replace('-', '.', $loginRecordLatest->login_at) }}
                                </div>
                            </div>
                            <div class="col-span-full sm:col-span-2">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    IP : {{ $loginRecordLatest->ip_address }}
                                </div>
                            </div>
                            <div class="col-span-full">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $loginRecordLatest->user_agent }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flow-root">
                        <div @click="Livewire.navigate('{{ route('mypage.inquiry.list') }}')" class="flex justify-between cursor-pointer mb-3">
                            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">로그인 관리</h1>
                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="grid grid-cols-6 gap-3">
                            <div class="col-span-full sm:col-span-4">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    최근 접속일 : {{ str_replace('-', '.', $loginRecordLatest->login_at) }}
                                </div>
                            </div>
                            <div class="col-span-full sm:col-span-2">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    IP : {{ $loginRecordLatest->ip_address }}
                                </div>
                            </div>
                            <div class="col-span-full">
                                <div class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $loginRecordLatest->user_agent }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flow-root">
                        <div @click="Livewire.navigate('{{ route('mypage.inquiry.list') }}')" class="flex justify-between cursor-pointer mb-3">
                            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">1:1 문의 내역</h1>
                            <svg class="w-6 h-6 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                            </svg>
                        </div>
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($inquiryList as $key => $inquiry)
                                <div wire:key="{{ $key }}" class="flex items-center justify-between py-3">
                                    <div class="flex flex-col flex-grow w-full">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-1">
                                            <a href="{{ route('mypage.inquiry.read', ['inquiryId' => $inquiry->id]) }}" wire:navigate>{{ $inquiry->subject }}</a>
                                        </div>
                                        <div class="flex text-xs text-gray-500 dark:text-gray-400 justify-end">
                                            <p class="mr-3">{{ $inquiry->categories }}</p>
                                            <p class="mr-3">{{ humanReadableDate($inquiry->created_at, 2) }}</p>
                                            <p>{{ ($inquiry->status === 1) ? '답변완료' : '미답변' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="flex items-center py-4">
                                    <div class="text-sm font-semibold text-gray-500 dark:text-gray-400">1:1 문의 내역이 없습니다.</div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>
