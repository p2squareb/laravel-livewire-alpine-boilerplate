<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><a href="{{ route('write.list', ['tableId' => $board->table_id]) }}" wire:navigate>{{ $board->table_name }}</a></h1>
                    </div>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto rounded-md">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <div class="grid grid-cols-6 gap-1">
                                        <div class="flex col-span-6">
                                            <h1 class="font-semibold text-gray-900 dark:text-white">{{ $writeData['write']->subject }}</h1>
                                        </div>
                                        <div class="flex-row sm:flex col-span-6 py-2 items-center justify-between border-b border-gray-500 dark:border-gray-400">
                                            <div class="flex items-center">
                                                <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                    @if ($writeData['write']->user->profile_photo_path)
                                                        <img class="w-6 h-6 mr-2 rounded-full" src="/storage/profiles/{{ $writeData['write']->user->profile_photo_path }}" alt="{{ $writeData['write']->writer }}'s avatar">
                                                    @else
                                                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                        </svg>
                                                    @endif
                                                    {{ $writeData['write']->writer }}
                                                </p>
                                                <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $writeData['write']->created_at }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-3 pr-2 justify-end">
                                                <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M4.998 7.78C6.729 6.345 9.198 5 12 5c2.802 0 5.27 1.345 7.002 2.78a12.713 12.713 0 0 1 2.096 2.183c.253.344.465.682.618.997.14.286.284.658.284 1.04s-.145.754-.284 1.04a6.6 6.6 0 0 1-.618.997 12.712 12.712 0 0 1-2.096 2.183C17.271 17.655 14.802 19 12 19c-2.802 0-5.27-1.345-7.002-2.78a12.712 12.712 0 0 1-2.096-2.183 6.6 6.6 0 0 1-.618-.997C2.144 12.754 2 12.382 2 12s.145-.754.284-1.04c.153-.315.365-.653.618-.997A12.714 12.714 0 0 1 4.998 7.78ZM12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $writeData['write']->hit }}
                                                </p>
                                                @if ($board->use_comment === 1)
                                                    <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M4 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h1v2a1 1 0 0 0 1.707.707L9.414 13H15a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4Z" clip-rule="evenodd"/>
                                                            <path fill-rule="evenodd" d="M8.023 17.215c.033-.03.066-.062.098-.094L10.243 15H15a3 3 0 0 0 3-3V8h2a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-1v2a1 1 0 0 1-1.707.707L14.586 18H9a1 1 0 0 1-.977-.785Z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $writeData['write']->comments_count }}
                                                    </p>
                                                @endif
                                                @if ($board->use_rate === 1)
                                                    <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $rateField }}
                                                    </p>
                                                @endif
                                                @if ($writeData['threeDotView'])
                                                    <button id="ddWrtRMenuBtn" data-dropdown-toggle="ddWrtRMenu" class="inline-flex items-center text-sm font-medium text-center text-gray-500 bg-white rounded-md hover:bg-gray-100 focus:outline-none dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300" type="button">
                                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                    <div id="ddWrtRMenu" class="z-10 hidden bg-white border border-gray-300 dark:border-gray-500 rounded shadow w-20 dark:bg-gray-700">
                                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="ddWrtRMenuBtn">
                                                            <li>
                                                                <a href="{{ route('write.update', ['tableId' => $board->table_id, 'writeId' => $writeId]) }}" wire:navigate class="inline-flex items-center px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>수정</a>
                                                            </li>
                                                            <li>
                                                                <a href="#" @click="$dispatch('open-confirm', {type: 'single-delete-link', link: '{{ route('write.delete', ['tableId' => $board->table_id, 'writeId' => $writeId]) }}', message: '정말로 게시글을 삭제하시겠습니까?<br>삭제된 데이터는 다시 복구 할 수 없습니다.'})" class="inline-flex items-center px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>삭제</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex col-span-6 items-center justify-end">
                                            <div class="flex items-center" x-data="{defaultIcon:true, successIcon:false, tooltip:false}">
                                                <span class="text-xs text-gray-600 dark:text-gray-400">{{ config('app.url') . $_SERVER['REQUEST_URI'] }}</span>
                                                <button class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-md p-2 inline-flex items-center justify-center"
                                                        @click="navigator.clipboard.writeText('{{ config('app.url') . $_SERVER['REQUEST_URI'] }}');
                                                        defaultIcon = !defaultIcon;
                                                        successIcon = !successIcon;
                                                        tooltip = !tooltip; console.log('Copied!');
                                                        setTimeout(() => {defaultIcon = !defaultIcon; successIcon = !successIcon;}, 2300);"
                                                >
                                                    <span x-show="defaultIcon">
                                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M17.5 3a3.5 3.5 0 0 0-3.456 4.06L8.143 9.704a3.5 3.5 0 1 0-.01 4.6l5.91 2.65a3.5 3.5 0 1 0 .863-1.805l-5.94-2.662a3.53 3.53 0 0 0 .002-.961l5.948-2.667A3.5 3.5 0 1 0 17.5 3Z"/>
                                                        </svg>
                                                    </span>
                                                    <span x-show="successIcon" class="text-xs hidden" :class="{'inline-flex': successIcon, 'hidden': !successIcon}">
                                                        <svg class="w-3.5 h-3.5 text-blue-700 dark:text-blue-500 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                                        </svg> Copied!
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-span-6 text-sm text-gray-900 dark:text-white">
                                            {!! $writeData['write']->content !!}
                                        </div>
                                        @if ($board->use_rate === 1)
                                            <div class="flex col-span-6 text-sm justify-center space-x-3 py-5 border-b border-gray-500 dark:border-gray-400">
                                                <button
                                                    @if (auth()->check()) wire:click.prevent="updateWriteRate('up')" @else @click="$dispatch('open-alert', {type: 'warning', next: 'close', message: '로그인 후 이용해주세요.'})" @endif
                                                type="button"
                                                    class="text-gray-600 border border-gray-600 hover:bg-gray-600 hover:text-white focus:outline-none font-medium rounded-md text-sm px-3 py-2 text-center inline-flex items-center dark:border-gray-500 dark:text-gray-500 dark:hover:text-white dark:hover:bg-gray-500">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                                @if ($rateField > 0)
                                                    <button type="button" class="px-3 py-2 text-sm font-medium rounded-md bg-white dark:bg-gray-800 border text-blue-700 dark:text-blue-500 border-blue-700 dark:border-blue-500">{{ ($rateField) }}</button>
                                                @elseif ($rateField < 0)
                                                    <button type="button" class="px-3 py-2 text-sm font-medium rounded-md bg-white dark:bg-gray-800 border text-red-700 dark:text-red-600 border-red-700 dark:border-red-600">{{ ($rateField) }}</button>
                                                @else
                                                    <button type="button" class="px-3 py-2 text-sm font-medium rounded-md bg-white dark:bg-gray-800 border dark:text-gray-400 border-gray-500 dark:border-gray-600">{{ ($rateField) }}</button>
                                                @endif
                                                <button
                                                    @if (auth()->check()) wire:click.prevent="updateWriteRate('down')" @else @click="$dispatch('open-alert', {type: 'warning', next: 'close', message: '로그인 후 이용해주세요.'})" @endif
                                                type="button"
                                                    class="text-gray-600 border border-gray-600 hover:bg-gray-600 hover:text-white focus:outline-none font-medium rounded-md text-sm px-3 py-2 text-center inline-flex items-center dark:border-gray-500 dark:text-gray-500 dark:hover:text-white dark:hover:bg-gray-500">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex col-span-6 items-center justify-between mt-3">
                                        <div class="flex items-center">
                                            @if (auth()->check() && $board->use_report === 1)
                                                <x-report id="ddReport" svg="wrt" :idx="$writeData['write']->id" />
                                            @endif
                                        </div>
                                        <div class="flex items-center">
                                            <button type="button" @click="Livewire.navigate('{{ route('write.list', array_merge(['tableId' => $board->table_id], request()->query())) }}')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">목록</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($board->use_comment === 1)
                <livewire:board.write-comment :board="$board" :write-id="$writeId" />
            @endif
        </div>

        <div class="hidden xl:block col-span-full xl:col-auto">
            <livewire:board.write-side />
        </div>
    </div>

    @once <x-confirm /> @endonce
    @once <x-alert /> @endonce
</main>
