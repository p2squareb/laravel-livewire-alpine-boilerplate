<div class="w-full bg-white rounded-md shadow dark:bg-gray-800 lg:px-2">
    <div class="flex items-start justify-between p-3 mt-3 border-b rounded-t dark:border-gray-700">
        <h3 class="text-lg font-semibold dark:text-white">
            회원 이용정지
        </h3>
        <button type="button" @click="$dispatch('close-modal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-md text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <div class="p-3 space-y-3">
        <div class="grid grid-cols-6 gap-3">
            <div class="col-span-6 sm:col-span-3">
                <label for="gubun-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">이용정지 구분</label>
                <input wire:model.live="gubun" id="gubun-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                <label for="gubun-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">이용정지</label>
                <input wire:model.live="gubun" id="gubun-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                <label for="gubun-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">이용정지 해제</label>
            </div>
            @if($this->gubun === '1')
                <div class="col-span-6 sm:col-span-3">
                    <label for="period_type-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">정지기간</label>
                    <select wire:model="period_type" id="period_type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <option selected value="">기간 선택</option>
                        <option value="3d">3일</option>
                        <option value="7d">7일</option>
                        <option value="1m">1개월</option>
                        <option value="3m">3개월</option>
                        <option value="6m">6개월</option>
                        <option value="1y">1년</option>
                        <option value="eternity">영구 정지</option>
                    </select>
                    @error('period_type')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                </div>
                <div x-data="{ count: 0, comment: @entangle('comment').defer }" x-effect="count = comment ? comment.length : 0" class="col-span-6">
                    <label for="cause" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">사유 (<span x-text="count" class="text-red-500"></span> / 200)</label>
                    <textarea id="cause" wire:model="cause" x-on:input="count = $event.target.value.length" maxlength="200" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"></textarea>
                    @error('cause')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                </div>
            @endif
        </div>
    </div>

    <div class="text-right p-3 mb-3 border-t border-gray-200 rounded-b dark:border-gray-700">
        <button wire:click.prevent="prohibitUser" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700" type="button">저장</button>
    </div>

    @once <x-alert /> @endonce
</div>

