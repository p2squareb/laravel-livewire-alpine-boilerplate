<div>
    <div class="flex items-center justify-center text-lg font-semibold dark:text-white mb-3">비밀번호 변경</div>
    <div class="w-full min-w-[330px] sm:w-[400px] mb-7 p-6 bg-white rounded-md shadow dark:bg-gray-800">
        <form wire:submit="updatePassword">
            <div class="-mt-2">
                <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">현재 비밀번호</label>
                <input type="password" id="current_password" wire:model="state.current_password" placeholder="대문자+특수문자 포함 (8~16자리)" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" autocomplete="current-password">
                @error('current_password')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">새로운 비밀번호</label>
                <input type="password" id="password" wire:model="state.password" placeholder="대문자+특수문자 포함 (8~16자리)" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" autocomplete="current-password">
                <input type="password" id="password_confirmation" wire:model="state.password_confirmation" placeholder="대문자+특수문자 포함 (8~16자리)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" autocomplete="current-password">
                @if ($errors->has('password') || $errors->has('password_confirmation'))
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                        @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                        @elseif($errors->has('password_confirmation'))
                            {{ $errors->first('password_confirmation') }}
                        @endif
                    </p>
                @endif
            </div>
            <button type="submit" wire:loading.attr="disabled" class="w-full mt-3 px-5 py-[7px] text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">비밀번호 변경하기</button>
            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                 x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms="" style="display: none;" class="text-sm text-green-500 mt-2 me-3">
                비밀번호가 변경되었습니다!
            </div>
        </form>
    </div>
</div>
