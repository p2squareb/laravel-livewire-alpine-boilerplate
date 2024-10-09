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
                                <a href="{{ route('admin.board.list') }}" wire:navigate class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">1:1 문의 관리</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">1:1 문의내역</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">1:1 문의내역</h1>
            </div>
            <div class="sm:flex">
                <div class="items-center mr-2 mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <label for="inquiryStatus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                    <select wire:model.live="inquiryStatus" id="inquiryStatus" class="rounded-md bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-500 focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="">전체</option>
                        <option value="0">미답변</option>
                        <option value="1">답변완료</option>
                    </select>
                </div>
                <div class="items-center mr-2 mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                    <select wire:model.live="category" id="category" class="rounded-md bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-500 focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="">전체</option>
                        @foreach($inquiryCategories as $key => $value)
                            <option value="{{ $value->category }}">{{ $value->category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="items-center mr-2 mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <label for="pageRows" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                    <select wire:model.live="pageRows" id="pageRows" class="rounded-md bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-500 focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="15">15행</option>
                        <option value="30">30행</option>
                        <option value="60">60행</option>
                        <option value="100">100행</option>
                    </select>
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <div class="flex items-center">
                        <div class="relative w-full">
                            <input type="search" wire:model="searchString" wire:keydown.enter="inquiries" id="searchString" class="block p-[7px] w-full md:w-[270px] z-20 text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="제목+내용 검색"/>
                            <button type="button" wire:click.prevent="inquiries" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </div>
                    </div>
                    <button type="button" @click="$dispatch('open-modal', {modalId : 'inquiry-category-modal'})" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700" >
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>문의유형 관리
                    </button>
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
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">No.</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">문의유형</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">제목</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">문의자</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">문의일</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">답변상태</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">답변자</th>
                            <th scope="col" class="p-4 text-sm font-medium text-center text-gray-500 uppercase dark:text-gray-400">답변일</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @foreach($inquiries as $inquiry)
                            <tr wire:key="{{$inquiry->id}}" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $inquiries->total() - ($inquiries->currentPage() - 1) * 10 - $loop->index }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $inquiry->categories }}</td>
                                <td class="p-4 text-sm text-gray-900 whitespace-nowrap dark:text-white cursor-pointer" @click="Livewire.navigate('{{ route('admin.inquiry.read', array_merge(['inquiryId' => $inquiry->id], $currentQueryString)) }}')">{{ $inquiry->subject }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ $inquiry->writer }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ humanReadableDate($inquiry->created_at, 3) }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ ($inquiry->status === 1) ? '답변완료' : '미답변' }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ ($inquiry->status === 1) ? $inquiry->writer : '-' }}</td>
                                <td class="p-4 text-sm text-center text-gray-900 whitespace-nowrap dark:text-white">{{ ($inquiry->status === 1) ? humanReadableDate($inquiry->answered_at, 3) : '-' }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $inquiries->links('vendor.livewire.common') }}
    <x-modal modalId="inquiry-category-modal" maxWidth="xl">
        <livewire:admin.inquiry.inquiry-category-manage />
    </x-modal>
</main>

