<div>
    <div class="flex items-center justify-center text-lg font-semibold dark:text-white mb-3">회원정보</div>
    <div class="w-full min-w-[330px] sm:w-[400px] mb-7 p-6 bg-white rounded-md shadow dark:bg-gray-800">
        <form wire:submit="updateProfileInformation">
            <div class="-mt-2">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">이메일</label>
                <input type="hidden" id="email" wire:model="state.email" value="{{ auth()->user()->email }}">
                <div class="text-sm text-gray-900 dark:text-white">{{ auth()->user()->email }}</div>
            </div>
            <div class="mt-3">
                <label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">닉네임</label>
                <input type="text" id="nickname" wire:model="state.nickname" value="{{ auth()->user()->nickname }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="닉네임을 입력해주세요." required>
                @error('nickname')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <button type="submit" class="w-full mt-3 px-5 py-[7px] text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">회원정보 수정하기</button>
            <div x-data="{ shown: false, timeout: null }" x-init="@this.on('saved', () => { clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 2000); })"
                 x-show.transition.out.opacity.duration.1500ms="shown" x-transition:leave.opacity.duration.1500ms="" style="display: none;" class="text-sm text-green-500 mt-2 me-3">
                회원정보가 수정되었습니다!
            </div>
        </form>
    </div>
</div>

