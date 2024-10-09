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
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">신고내역</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">신고내역</h1>
            </div>
            <div class="sm:flex">
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
                        <select wire:model.live="reportStatus" id="reportStatus" class="rounded bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-primary-500">
                            <option value="">처리 상태</option>
                            <option value="0">처리중</option>
                            <option value="1">처리완료</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <div class="relative w-full">
                        <select id="searchKind" wire:model="searchKind" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                            <option value="title">제목/내용</option>
                            <option value="writer">작성자</option>
                            <option value="reporter">신고자</option>
                        </select>
                    </div>
                    <div class="relative w-full">
                        <input type="search" wire:model="searchString" wire:keydown.enter="reports" id="searchString" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="제목+내용 검색"/>
                        <button type="button" wire:click.prevent="reports" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
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
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">구분</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">사유</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">제목/내용</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">작성자</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">신고일</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">신고자</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">-</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($reports as $key => $report)
                            <tr wire:key="{{ $key }}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $report->board->table_name }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ is_null($report->comment_id) ? '게시글' : '댓글' }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ str_replace(' ', '', $report->field) }}
                                </td>
                                <td class="p-4 text-sm items-center text-left @if ($report->is_delete === 1) text-gray-400 dark:text-gray-500 line-through @else text-gray-900 dark:text-white @endif whitespace-nowrap max-w-xl truncate">
                                    <a href="{{ route('write.read', ['tableId' => $report->table_id, 'writeId' => $report->write_id]) }}" target="_blank">
                                        {{ $report->title }}
                                    </a>
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">
                                    @if (is_null($report->comment_id))
                                        {{ $report->write->writer }}
                                    @else
                                        {{ $report->comment->writer }}
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($report->created_at, 1) }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $report->user->nickname }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white space-x-1">
                                    @if ($report->status === 0)
                                        <button
                                            type="button"
                                            @click="$dispatch('open-confirm', {type: 'single-delete', link: '', message: '신고받은 게시글/댓글을 삭제 처리하시겠습니까?<br>삭제 상태로 변경되며 복원은 가능하나 관련된 포인트는 복원이 되지 않습니다.'})" wire:click="$set('deleteRowId', {{ $report->id }})"
                                            class="inline-flex items-center px-3 py-[7px] text-sm text-center text-white bg-red-600 rounded-md hover:bg-red-800"
                                        >
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>게시물/댓글 삭제
                                        </button>
                                        <button
                                            type="button"
                                            @click="$dispatch('open-confirm', {type: 'single-return-back', link: '', message: '신고 요청을 반려하시겠습니까?'})" wire:click="$set('returnBackRowId', {{ $report->id }})"
                                            class="inline-flex items-center px-3 py-[7px] text-sm text-center text-white bg-indigo-600 rounded-md hover:bg-indigo-800"
                                        >
                                            <svg class="w-4 h-4 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 9H8a5 5 0 0 0 0 10h9m4-10-4-4m4 4-4 4"/>
                                            </svg>신고 반려
                                        </button>
                                    @else
                                        @if ($report->is_delete === 1)
                                            게시물 삭제됨
                                        @else
                                            반려
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $reports->links('vendor.livewire.common') }}
    @once <x-confirm /> @endonce
    @once <x-alert /> @endonce
</main>

