<main class="bg-gray-50 dark:bg-gray-900">
    @if ($passCheck)
        <button id="auto-click-button" wire:click="deleteWrite"></button>
        <script>
            document.addEventListener('livewire:navigated', () => {
                function waitForElement(selector, callback) {
                    const element = document.querySelector(selector);
                    if (element) {
                        callback(element);
                    } else {
                        setTimeout(() => waitForElement(selector, callback), 100);
                    }
                }

                waitForElement('#auto-click-button', (button) => {
                    button.click();
                });
            })
        </script>
    @else
        <div class="flex flex-col items-center px-6 pt-8 mx-auto h-full dark:bg-gray-900">
            <div class="w-full max-w-sm p-6 sm:p-8 bg-white rounded-md shadow dark:bg-gray-800 mb-10">
                <div class="">
                    <label for="passwd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호</label>
                    <input type="password" wire:model="passwd" id="passwd" placeholder="비밀번호를 입력해주세요." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required>
                    @error('passwd')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                    @error('auth-failed')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                </div>
                <div class="flex mt-3 space-x-3">
                    <button type="button" @click="Livewire.navigate('{{ route('write.read', ['tableId' => $board->table_id, 'writeId' => $writeId]) }}')" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700 w-full">이전</button>
                    <button type="button" wire:click.prevent="checkPassword" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700 w-full">확인</button>
                </div>
            </div>
        </div>
    @endif

    @once <x-alert /> @endonce
</main>
