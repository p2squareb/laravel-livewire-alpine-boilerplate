<div>
    <div class="flex items-center justify-center text-lg font-semibold dark:text-white">Browser Sessions</div>
    <div class="flex items-center justify-center text-sm text-gray-500 dark:text-gray-400 mb-3">다른 브라우저 및 장치에서 활성 세션을 관리하고 로그아웃할 수 있습니다.</div>
    <div class="w-full min-w-[330px] sm:w-[400px] mb-7 p-6 bg-white rounded-md shadow dark:bg-gray-800">
        <div class="-mt-2">
            <label for="subtitle" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                필요한 경우 모든 장치에서 다른 모든 브라우저 세션에서 로그아웃할 수 있습니다.<br>최근 세션 중 일부는 아래에 나열되어 있습니다.<br>그러나 이 목록이 전부가 아닐 수도 있습니다.<br>계정이 손상되었다고 생각되면 암호를 업데이트해야 합니다.
            </label>
        </div>
        @if (count($this->sessions) > 0)
            <div class="mt-3 space-y-3">
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-700 dark:text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-700 dark:text-gray-300">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                            @endif
                        </div>
                        <div class="ms-3">
                            <div class="text-sm text-gray-700 dark:text-gray-300">
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                            </div>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},
                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                    @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <button type="button" wire:click.prevent="confirmLogout" class="w-full mt-4 px-5 py-[7px] text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">다른 브라우저 및 세션에서 로그아웃</button>

        <x-dialog-modal wire:model.live="confirmingLogout" maxWidth="lg">
            <x-slot name="title">
                Browser Sessions
            </x-slot>
            <x-slot name="content">
                {{ __('모든 장치와 다른 브라우저 세션에서 로그아웃하려면 비밀번호를 입력하십시오.') }}
                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <input type="password" autocomplete="current-password" placeholder="{{ __('Password') }}" x-ref="password" wire:model="password" wire:keydown.enter="logoutOtherBrowserSessions" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                    @error('password')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                </div>
            </x-slot>
            <x-slot name="footer">
                <button type="button" wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled" class="mt-4 px-5 py-[7px] text-sm font-medium text-center text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-blue-red dark:hover:bg-red-700">취소하기</button>
                <button type="button" wire:click="logoutOtherBrowserSessions" class="mt-4 px-5 py-[7px] text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">실행하기</button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
