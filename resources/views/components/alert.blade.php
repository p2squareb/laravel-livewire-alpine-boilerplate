<div
    x-data="{ show : false, alertType : '', alertNext : '', alertLink : '', alertMsg : ''}"
    x-show="show"
    x-on:open-alert.window="show = true; alertType = $event.detail.type; alertNext = $event.detail.next; alertLink = $event.detail.link; alertMsg = $event.detail.message;"
    x-on:close-alert.window="show = false"
    style="display: none;"
    class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900 dark:bg-opacity-85"></div>
    </div>

    <div x-show="show" class="fixed inset-0 flex items-center justify-center transform transition-all"
         x-trap.inert.noscroll="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="relative w-full max-w-sm px-4">
            <div class="relative bg-white rounded-md shadow dark:bg-gray-800">
                <div class=" py-8 text-center">
                    <div x-show="alertType === 'success'">
                        <svg class="w-10 h-10 mx-auto text-green-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <h3 class="mt-3 mb-6 text-sm text-gray-800 dark:text-gray-300" x-html="alertMsg"></h3>
                        <button></button>
                        <button type="button" x-show="alertNext === 'close'" @click="$dispatch('close-alert')" class="px-7 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">확인</button>
                        <button x-show="alertNext === 'redirect'" @click="Livewire.navigate(alertLink)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-7 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">확인</button>
                        <button></button>
                    </div>
                    <div x-show="alertType === 'warning'">
                        <svg class="w-10 h-10 mx-auto text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-3 mb-6 text-sm text-gray-800 dark:text-gray-300" x-html="alertMsg"></h3>
                        <button></button>
                        <button type="button" x-show="alertNext === 'close'" @click="$dispatch('close-alert')" class="px-7 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">확인</button>
                        <button x-show="alertNext === 'redirect'" @click="Livewire.navigate(alertLink)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-7 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">확인</button>
                        <button></button>
                    </div>
                    <div x-show="alertType === 'error'">
                        <svg class="w-10 h-10 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-3 mb-6 text-sm text-gray-800 dark:text-gray-300">데이터 처리중 오류가 발생하였습니다.<br>관리자에게 문의해주세요.</h3>
                        <button type="button" @click="$dispatch('close-alert')" class="px-7 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">확인</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>





