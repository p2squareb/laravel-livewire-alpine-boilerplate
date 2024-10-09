<main>
    <div class="grid grid-cols-1 px-3 xl:px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-3">
                <div class="col-span-full sm:col-span-1 p-3 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
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
                            <h3 class="mb-1 text-base font-bold text-gray-900 dark:text-white">프로필 이미지</h3>
                            <div class="mb-1 text-sm text-gray-500 dark:text-gray-400">PNG, JPG, GIF, Image only</div>
                            <div class="mb-1 text-sm text-gray-500 dark:text-gray-400">Max. 128x128px</div>
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

                {{--<div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="flow-root">
                        <div @click="Livewire.navigate('{{ route('mypage.login-record.list') }}')" class="flex justify-between cursor-pointer mb-7">
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
                </div>--}}

            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0">
            <livewire:mypage.my-side />
        </div>
    </div>
</main>
