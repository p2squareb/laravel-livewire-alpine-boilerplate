<main>
    <div class="p-3 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="{{ route('admin.board.list') }}" wire:navigate class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">회원 관리</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">회원 리스트</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">회원 리스트</h1>
            </div>
            <div class="sm:flex justify-between">
                <div class="items-center mr-0 sm:mr-2 mb-3 sm:flex sm:space-x-2 sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <select id="pageRows" wire:model.live="pageRows" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="15">15개</option>
                                <option value="30">30개</option>
                                <option value="50">50개</option>
                                <option value="100">100개</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <select id="group" wire:model.live="group" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="">그룹명</option>
                                @foreach($userGroup as $group)
                                    <option value="{{ $group->level }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <select id="status" wire:model.live="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="">회원상태</option>
                                <option value="1">정상</option>
                                <option value="2">탈퇴</option>
                                <option value="3">정지</option>
                                <option value="4">휴면</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="sm:flex items-center  sm:space-x-2">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <select id="searchKind" wire:model="searchKind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="" selected>검색 구분</option>
                                <option value="nickname" selected>닉네임</option>
                                <option value="email">이메일</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <input type="search" wire:model="searchString" wire:keydown.enter="users" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="검색어를 입력해주세요."/>
                            <button type="button" wire:click.prevent="users" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <button type="button" @click="$dispatch('open-modal', {modalId : 'create-user-modal'})" class="inline-flex w-full items-center justify-center px-3 py-[6px] text-sm font-medium text-center text-white rounded-md bg-blue-700 hover:bg-blue-800 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700">
                                <svg class="w-6 h-6 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                회원 등록
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:flex mt-3">
                <div class="sm:flex items-center sm:space-x-2">
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <select id="newGroup" wire:model="newGroup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="">변경할 그룹 선택</option>
                                @foreach($userGroup as $group)
                                    <option value="{{ $group->level }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <button type="button" wire:click.prevent="moveGroupUsers" class="inline-flex w-full items-center justify-center px-3 py-[8px] text-sm font-medium text-center text-white rounded-md bg-indigo-700 hover:bg-indigo-800 sm:w-auto dark:bg-indigo-600 dark:hover:bg-indigo-700">그룹 변경</button>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center mb-3 md:mb-0"></div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <button type="button" @if (count($selectedRows) > 0) @click="$dispatch('open-modal', {modalId : 'prohibit-user-modal'})" @endif class="inline-flex w-full items-center justify-center px-3 py-[8px] text-sm font-medium text-center text-white rounded-md bg-indigo-700 hover:bg-indigo-800 sm:w-auto dark:bg-indigo-600 dark:hover:bg-indigo-700">이용정지</button>
                        </div>
                    </div>
                    <div class="hidden md:flex items-center mb-3 md:mb-0"></div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <button type="button" wire:click.prevent="moveGroupUsers" class="inline-flex w-full items-center justify-center px-3 py-[8px] text-sm font-medium text-center text-white rounded-md bg-indigo-700 hover:bg-indigo-800 sm:w-auto dark:bg-indigo-600 dark:hover:bg-indigo-700">포인트 지급/차감</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input wire:model.live="selectAllRow" id="checkbox-all" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">회원</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">그룹</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400 min-w-[100px]">가입유형</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400 min-w-[80px]">포인트</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400 min-w-[100px]">가입일</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">상태</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">최근 로그인</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">-</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($users as $user)
                            <tr wire:key="{{$user->id}}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input wire:model.live="selectedRows" value="{{ $user->id }}" id="checkbox-{{ $user->id }}" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-{{ $user->id }}" class="sr-only">checkbox</label>
                                    </div>
                                </td>
                                <td class="flex items-center p-4 space-x-3 whitespace-nowrap">
                                    @if ($user->profile_photo_path)
                                        <img class="w-8 h-8 rounded-full" src="/storage/profiles/{{ $user->profile_photo_path }}" alt="{{ $user->nickname }}'s avatar">
                                    @else
                                        <svg class="w-8 h-8 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                        </svg>
                                    @endif
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->nickname }}</div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $user->group->name }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $user->social_type }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ number_format($user->point) }}pt</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($user->created_at, 3) }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex flex-row items-center justify-center">
                                        @if ($user->status === 1)
                                            <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2"></div>정상
                                        @elseif ($user->status === 2)
                                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>탈퇴
                                        @elseif ($user->status === 3)
                                            <div class="h-2.5 w-2.5 rounded-full bg-orange-400 mr-2"></div>정지
                                        @elseif ($user->status === 4)
                                            <div class="h-2.5 w-2.5 rounded-full bg-neutral-500 mr-2"></div>휴면
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ humanReadableDate($user->last_login_at, 3) }}<br>{{ $user->login_ip }}
                                </td>
                                <td class="p-4 text-center space-x-2 whitespace-nowrap">
                                    <button type="button" @click="Livewire.navigate('{{ route('admin.user.read', array_merge(['userId' => $user->id], $currentQueryString)) }}')" class="inline-flex items-center px-3 py-[7px] text-sm font-semibold text-center text-white rounded-md bg-teal-700 hover:bg-teal-800 dark:bg-teal-600 dark:hover:bg-teal-700">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>상세
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $users->links('vendor.livewire.common') }}
    <x-modal modalId="create-user-modal" maxWidth="xl">
        <livewire:admin.user.user-create/>
    </x-modal>
    <x-modal modalId="prohibit-user-modal" maxWidth="xl">
        <livewire:admin.user.user-prohibit-update :prohibit-selected-user="$selectedRows" :key="rand()"/>
    </x-modal>
</main>

