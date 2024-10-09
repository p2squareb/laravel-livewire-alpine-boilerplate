<div class="w-full bg-white rounded-md shadow dark:bg-gray-800 lg:px-2">
    <div class="flex items-start justify-between p-3 mt-3 border-b rounded-t dark:border-gray-700">
        <h3 class="text-lg font-semibold dark:text-white">
            회원 등록
        </h3>
        <button type="button" @click="$dispatch('close-modal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <div class="p-3 space-y-3">
        <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
            @if ($profile)
                <img src="{{ $profile->temporaryUrl() }}" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0">
            @else
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-28 h-28 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-20 h-20 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg>
                    </div>
                </label>
            @endif
            <div>
                <h3 class="mb-3 text-xm font-bold text-gray-900 dark:text-white">프로필 이미지</h3>
                <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                    JPG, GIF or PNG. Max size of 3MB
                </div>
                <div class="flex items-center space-x-4">
                    <button type="button" onclick="document.getElementById('profile').click()" class="inline-flex items-center px-3 py-[7px] text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>
                        이미지 업로드
                    </button>
                    <input wire:model="profile" id="profile" accept="image/*" type="file" class="hidden" />
                    @if ($profile)
                        <button wire:click="$set('profile', null)" type="button" class="py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            이미지 삭제
                        </button>
                    @endif
                </div>
                @error('profile')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-6 gap-3">
            <div class="col-span-6 sm:col-span-3">
                <label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">닉네임</label>
                <input type="text" id="nickname" wire:model="nickname" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="user nickname">
                @error('nickname')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">이메일</label>
                <input type="email" id="email" wire:model="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="example@company.com">
                @error('email')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="passwd" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호</label>
                <input type="password" id="passwd" wire:model="passwd" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                @error('passwd')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="passwd_confirm" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호 확인</label>
                <input type="password" id="passwd_confirm" wire:model="passwd_confirm" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                @error('passwd_confirm')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
        </div>
    </div>

    <div class="text-right p-3 mb-3 border-t border-gray-200 rounded-b dark:border-gray-700">
        <button wire:click.prevent="createUser" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700" type="button">생성</button>
    </div>

    @once <x-alert /> @endonce
</div>

