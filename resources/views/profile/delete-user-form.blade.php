<div>
    <div class="flex items-center justify-center text-lg font-semibold dark:text-white mb-3">회원탈퇴</div>
    <div class="w-full min-w-[330px] sm:w-[400px] mb-7 p-6 bg-white rounded-md shadow dark:bg-gray-800">
        <div class="-mt-2">
            <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">회원탈퇴시 모든 리소스와 데이터에 접근이 불가능합니다.</label>
        </div>
        <button type="button" wire:click="confirmUserDeletion" class="w-full mt-3 px-5 py-[7px] text-sm font-medium text-center text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700">회원 탈퇴하기</button>

        <x-dialog-modal wire:model.live="confirmingUserDeletion" maxWidth="lg">
            <x-slot name="title">
                {{ __('회원탈퇴') }}
            </x-slot>

            <x-slot name="content">
                {{ __('회원 탈퇴 하시겠습니까? 탈퇴시 해당 계정으로는 모든 리소스와 데이터에 접근이 불가능합니다. 암호를 입력하십시오.') }}
                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <input type="password" autocomplete="current-password" placeholder="{{ __('Password') }}" x-ref="password" wire:model="password" wire:keydown.enter="deleteUser" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                    @error('password')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                </div>
            </x-slot>

            <x-slot name="footer">
                <button type="button" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled" class="mt-4 px-5 py-[7px] text-sm font-medium text-center text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-blue-red dark:hover:bg-red-700">취소하기</button>
                <button type="button" wire:click="deleteUser" class="mt-4 px-5 py-[7px] text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">탈퇴하기</button>
            </x-slot>
        </x-dialog-modal>
    </div>
</div>
