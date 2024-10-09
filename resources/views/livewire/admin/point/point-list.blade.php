<main>
    <x-modal modalId="create-point-modal" maxWidth="xl">
        <livewire:admin.point.point-create />
    </x-modal>
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
                                <a href="{{ route('admin.board.list') }}" wire:navigate class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">포인트 관리</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">포인트 내역</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">포인트 내역</h1>
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
                            <select id="pointType" wire:model.live="pointType" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="">지급/차감</option>
                                <option value="P">지급</option>
                                <option value="M">차감</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <select id="pagePeriod" wire:model.live="pagePeriod" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                <option value="all">지급/차감일</option>
                                <option value="7">7일</option>
                                <option value="30">30일</option>
                                <option value="3m">3개월</option>
                                <option value="6m">6개월</option>
                                <option value="1y">1년</option>
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
                            <input type="search" wire:model="searchString" wire:keydown.enter="points" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="검색어를 입력해주세요."/>
                            <button type="button" wire:click.prevent="points" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <button type="button" @click="$dispatch('open-modal', {modalId : 'create-point-modal'})" class="inline-flex w-full items-center justify-center px-3 py-[6px] text-sm font-medium text-center text-white rounded-md bg-blue-700 hover:bg-blue-800 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700">
                                <svg class="w-6 h-6 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                지급/차감 등록
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center mb-3 md:mb-0">
                        <div class="relative w-full">
                            <button wire:click="excelExport" class="inline-flex w-full items-center justify-center px-3 py-[7px] text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-md hover:bg-gray-100 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path></svg>
                                엑셀 다운로드
                            </button>
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
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">회원</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">구분</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">지급/차감</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">금액</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">지금/차감일</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">사유</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">주체</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">등록자</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                        @foreach($points_list as $point)
                            <tr wire:key="{{$point->id}}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="flex items-center p-4 space-x-3 whitespace-nowrap">
                                    @if ($point->user->profile_photo_path)
                                        <img class="w-8 h-8 rounded-full" src="/storage/profiles/{{ $point->user->profile_photo_path }}" alt="{{ $point->user->nickname }}'s avatar">
                                    @else
                                        <svg class="w-8 h-8 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                        </svg>
                                    @endif
                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $point->user->nickname }}</div>
                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $point->user->email }}</div>
                                    </div>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($point->point_item === 'join')
                                        회원가입
                                    @elseif ($point->point_item === 'login')
                                        로그인
                                    @elseif ($point->point_item === 'write')
                                        게시글 작성
                                    @elseif ($point->point_item === 'write_comment')
                                        댓글 추가
                                    @elseif ($point->point_item === 'write_up')
                                        게시글 추천
                                    @elseif ($point->point_item === 'write_down')
                                        게시글 비추천
                                    @elseif ($point->point_item === 'comment')
                                        댓글 작성
                                    @elseif ($point->point_item === 'comment_up')
                                        댓글 추천
                                    @elseif ($point->point_item === 'comment_down')
                                        댓글 비추천
                                    @elseif ($point->point_item === 'admin')
                                        관리자 지금/차감
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($point->point_type === 'P')
                                        <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full dark:bg-green-200 dark:text-green-900">지급</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full dark:bg-red-200 dark:text-red-900">차감</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $point->amount }}pt</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($point->created_at, 3) }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $point->reason }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($point->to_user_id === $point->from_user_id)
                                        본인
                                    @else
                                        {{ $point->sender->nickname }}<br>{{ $point->sender->email }}
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $point->processed_by }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $points_list->links('vendor.livewire.common') }}
</main>

