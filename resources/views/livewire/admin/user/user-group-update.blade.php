<div class="w-full bg-white rounded-md shadow dark:bg-gray-800 lg:px-2">
    <div class="flex items-start justify-between p-3 mt-3 border-b rounded-t dark:border-gray-700">
        <h3 class="text-lg font-semibold dark:text-white">
            그룹 수정
        </h3>
        <button type="button" @click="$dispatch('close-modal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-md text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <div class="p-3 space-y-3">
        <div class="grid grid-cols-6 gap-3">
            <div class="col-span-6 sm:col-span-3">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">그룹명</label>
                <input type="text" id="name" wire:model="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="그룹명">
                @error('name')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">레벨</label>
                <select wire:model="level" id="level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                    <option selected>레벨 선택</option>
                    <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
                    <option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
                    <option value="11">11</option>
                </select>
                @error('level')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div class="col-span-6">
                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">설명</label>
                <input type="text" id="comment" wire:model="comment" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
            </div>
        </div>
    </div>

    <div class="text-right p-3 mb-3 border-t border-gray-200 rounded-b dark:border-gray-700">
        <button wire:click.prevent="updateUserGroup" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700" type="button">수정</button>
    </div>

    @once <x-alert /> @endonce
</div>

