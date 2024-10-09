<div class="w-full bg-white rounded-md shadow dark:bg-gray-800 lg:px-2">
    <div class="flex items-start justify-between p-3 mt-3 border-b rounded-t dark:border-gray-700">
        <h3 class="text-lg font-semibold dark:text-white">
            포인트 지급/차감 등록
        </h3>
        <button type="button" @click="$dispatch('close-modal')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-md text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <div class="p-3 space-y-3">
        <div class="grid grid-cols-6 gap-3">
            <div class="col-span-6 sm:col-span-3">
                <label for="point_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">지급/차감</label>
                <input wire:model.live="point_type" id="point_type-1" type="radio" value="P" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                <label for="point_type-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">지급</label>
                <input wire:model.live="point_type" id="point_type-0" type="radio" value="M" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                <label for="point_type-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">차감</label>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">지급 금액</label>
                <div class="flex">
                    <span class="inline-flex items-center px-2 text-sm text-gray-900 bg-gray-200 border rounded-e-0 border-gray-300 border-e-0 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        @if($point_type === 'P')
                            <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                            </svg>
                        @else
                            <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/>
                            </svg>
                        @endif
                    </span>
                    <input type="text" wire:model="amount" x-init="$el.addEventListener('input', () => $el.value = $el.value.replace(/[^0-9]/g, ''))" class="rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-[7px]  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="숫자만 입력해주세요.">
                </div>
                @error('amount')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
            <div class="col-span-6">
                <label for="group" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">대상 회원</label>
                <select id="group" wire:model="group" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 p-[6px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                    <option value="">그룹 선택</option>
                    @foreach($userGroup as $group)
                        <option value="{{ $group->level }}">{{ $group->name }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model="searchString" id="searchString" class="ml-1 rounded-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[230px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="닉네임+이메일 검색">
                <button type="button" wire:click.prevent="searchUsers" class="ml-1 inline-flex items-center px-3 py-[7px] text-sm font-medium text-center text-white rounded-md bg-green-700 hover:bg-green-800 dark:bg-green-600 dark:hover:bg-green-700">회원 조회</button>
                @if ($searchUsers)
                    <div class="rounded max-h-60 overflow-auto">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                            @foreach($searchUsers as $user)
                                <li class="flex items-center text-sm text-gray-900 dark:text-white p-2">
                                    <input wire:model.live="selectedUserIds" value="{{ $user->id }}" id="checkbox-{{ $user->id }}" type="checkbox" class="w-4 h-4 mr-2 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-{{ $user->id }}" class="mr-2">{{ $user->nickname }} ({{ $user->email }})</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="space-x-2">
                        @foreach($selectedUsers as $user)
                            <button type="button" class="inline-flex items-center text-white bg-indigo-700 hover:bg-indigo-800 font-medium rounded-md text-sm px-3 py-[4px] mb-1 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700">
                                {{ $user['nickname'] }}
                                <svg wire:click="removeSelectedUser({{ $user['id'] }})" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            </button>
                        @endforeach
                    </div>
                @endif
                @error('selectedUserIds')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                <div class="mt-1 text-xs text-yellow-700 dark:text-yellow-500">
                    선택 후 대상 회원 중 일부가 휴면회원 및 탈퇴회원으로 전환된 경우 해당 회원은 지급/차감 대상에서 제외됩니다.
                </div>
            </div>
            <div x-data="{ count: 0, reason: @entangle('reason') }"
                 x-init="$watch('reason', value => count = value.length);
                  $watch('count', value => { if(value === 0) { reason = ''; } });"
                 x-on:reset-reason.window="count = 0; reason = '';"  class="col-span-6">
                <label for="reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">사유 (<span x-text="count" class="text-red-500"></span> / 200)</label>
                <textarea wire:model="reason" x-on:input="count = $event.target.value.length" maxlength="200" class="h-20 shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"></textarea>
                @error('reason')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
            </div>
        </div>
    </div>

    <div class="text-right p-3 mb-3 border-t border-gray-200 rounded-b dark:border-gray-700">
        <button wire:click.prevent="createPoint" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700" type="button">저장</button>
    </div>

    @once <x-alert /> @endonce
</div>

