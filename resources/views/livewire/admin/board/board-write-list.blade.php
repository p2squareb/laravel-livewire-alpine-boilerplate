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
                                <a href="{{ route('admin.board.list') }}" wire:navigate class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">게시판 관리</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">게시글 관리</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">게시글 관리</h1>
            </div>
            <div class="sm:flex">
                <div class="items-center sm:mr-2 mb-3 sm:flex sm:mb-0">
                    <div class="relative w-full">
                        <select id="boardId" wire:model.live="boardId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                            <option value="">게시판 선택</option>
                            @foreach($boardList as $board)
                                <option value="{{ $board->id }}">{{ $board->table_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="items-center sm:mr-2 mb-3 sm:flex sm:mb-0">
                    <div class="relative w-full">
                        <select wire:model.live="deleteStatus" id="deleteStatus" class="rounded bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-primary-500">
                            <option value="">삭제 상태</option>
                            <option value="1">삭제</option>
                            <option value="0">미삭제</option>
                        </select>
                    </div>
                </div>
                <div class="items-center sm:mr-2 mb-3 sm:flex sm:mb-0">
                    <div class="relative w-full">
                        <select wire:model.live="pageRows" id="pageRows" class="rounded bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-primary-500">
                            <option value="15">15행</option>
                            <option value="30">30행</option>
                            <option value="60">50행</option>
                            <option value="100">100행</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <div class="relative w-full">
                        <select id="searchKind" wire:model="searchKind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                            <option value="">제목+내용</option>
                            <option value="subject">제목</option>
                            <option value="content">내용</option>
                            <option value="writer">작성자</option>
                        </select>
                    </div>
                    <div class="relative w-full">
                        <input type="search" wire:model="searchString" wire:keydown.enter="writes" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="제목+내용 검색"/>
                        <button type="button" wire:click.prevent="writes" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
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
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">게시판명</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">제목</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">댓글</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">추천</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">조회</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">작성자</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">작성일</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">-</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">-</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($writes as $write)
                            <tr wire:key="{{$write->id}}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $write->board->table_name }}</td>
                                <td class="p-4 text-sm items-center text-left @if ($write->is_delete === 1) text-gray-400 dark:text-gray-500 line-through @else text-gray-900 dark:text-white @endif whitespace-nowrap max-w-xl truncate">
                                    <a href="{{ route('write.read', ['tableId' => $write->table_id, 'writeId' => $write->id]) }}" target="_blank">
                                        @if ($write->is_delete === 1)[삭제됨]@endif{{ $write->subject }}
                                    </a>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($write->board->use_comment === 1)
                                        {{ formatNumberWithK($write->comment_count) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($write->board->use_rate === 1)
                                        @if ($write->rate_up - $write->rate_down > 0)
                                            <div class="text-blue-700 dark:text-blue-500">{{ formatNumberWithK($write->rate_up - $write->rate_down) }}</div>
                                        @elseif ($write->rate_up - $write->rate_down < 0)
                                            <div class="text-red-700 dark:text-red-600">{{ formatNumberWithK($write->rate_up - $write->rate_down) }}</div>
                                        @else
                                            <div class="text-gray-900 dark:text-white">{{ formatNumberWithK($write->rate_up - $write->rate_down) }}</div>
                                        @endif
                                    @else
                                        <div class="text-gray-900 dark:text-white">-</div>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ formatNumberWithK($write->hit) }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $write->writer }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($write->created_at, 1) }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($write->is_delete === 0)
                                        <button
                                            type="button"
                                            @click="$dispatch('open-confirm', {type: 'single-delete', link: '', message: '삭제 처리하시겠습니까?<br>삭제 이후에 복원이 가능합니다.'})" wire:click.prevent="$set('deleteRowId', {{ $write->id }})"
                                            class="inline-flex items-center px-3 py-[7px] text-sm font-medium text-center text-white bg-red-600 rounded-md hover:bg-red-800"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>삭제
                                        </button>
                                    @else
                                        <button type="button" wire:click.prevent="restoreWrite({{ $write->id }})" class="inline-flex items-center px-3 py-[7px] text-sm font-medium text-center text-white bg-teal-600 rounded-md hover:bg-teal-800">
                                            <svg class="w-4 h-4 mr-1 -ml-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M5.027 10.9a8.729 8.729 0 0 1 6.422-3.62v-1.2A2.061 2.061 0 0 1 12.61 4.2a1.986 1.986 0 0 1 2.104.23l5.491 4.308a2.11 2.11 0 0 1 .588 2.566 2.109 2.109 0 0 1-.588.734l-5.489 4.308a1.983 1.983 0 0 1-2.104.228 2.065 2.065 0 0 1-1.16-1.876v-.942c-5.33 1.284-6.212 5.251-6.25 5.441a1 1 0 0 1-.923.806h-.06a1.003 1.003 0 0 1-.955-.7A10.221 10.221 0 0 1 5.027 10.9Z"></path></svg>복원
                                        </button>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    <button
                                        type="button"
                                        @click="$dispatch('open-confirm', {type: 'single-remove', link: '', message: '데이터를 삭제하시겠습니까?<br>삭제된 데이터는 다시 복구 할 수 없습니다.'})" wire:click.prevent="$set('removeRowId', {{ $write->id }})"
                                        class="inline-flex items-center px-3 py-[7px] text-sm font-medium text-center text-white bg-red-600 rounded-md hover:bg-red-800"
                                    >
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>데이터 삭제
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
    {{ $writes->links('vendor.livewire.common') }}
    @once <x-confirm /> @endonce
    @once <x-alert /> @endonce
</main>

