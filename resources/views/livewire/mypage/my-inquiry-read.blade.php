<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><a href="{{ route('mypage.inquiry.list') }}" wire:navigate>1:1 문의내역</a></h1>
                    </div>
                    <div class="flex flex-col">
                        <div class="overflow-x-auto rounded-md">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden shadow sm:rounded-md">
                                    <div class="grid grid-cols-6 gap-1">
                                        <div class="flex col-span-6">
                                            <h1 class="font-semibold text-gray-900 dark:text-white">{{ $inquiryData->subject }}</h1>
                                        </div>
                                        <div class="flex-row sm:flex col-span-6 py-2 items-center justify-between border-b border-gray-500 dark:border-gray-400">
                                            <div class="flex items-center">
                                                <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                    @if ($inquiryData->profile_photo_path)
                                                        <img class="w-6 h-6 mr-2 rounded-full" src="/storage/profiles/{{ $inquiryData->profile_photo_path }}" alt="{{ $inquiryData->writer }}'s avatar">
                                                    @else
                                                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                        </svg>
                                                    @endif
                                                    {{ $inquiryData->writer }}
                                                </p>
                                                <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $inquiryData->created_at }}
                                                </p>
                                            </div>
                                            <div class="flex items-center space-x-3 pr-2 justify-end">
                                                <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400"></p>
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
                                            {!! $inquiryData->content !!}
                                        </div>
                                        @if ($inquiryData->status === 1)
                                            <div class="col-span-6 text-sm text-gray-900 dark:text-white mt-3 pt-3 border-t border-gray-500 dark:border-gray-400">
                                                <div class="flex items-center mb-3">
                                                    <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                                        @if ($inquiryData->answer->profile_photo_path)
                                                            <img class="w-6 h-6 mr-2 rounded-full" src="/storage/profiles/{{ $inquiryData->answer->profile_photo_path }}" alt="{{ $inquiryData->answer_writer }}'s avatar">
                                                        @else
                                                            <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                                            </svg>
                                                        @endif
                                                        {{ $inquiryData->answer_writer }}
                                                    </p>
                                                    <p class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400">
                                                        <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $inquiryData->answered_at }}
                                                    </p>
                                                </div>
                                                {!! $inquiryData->answer_content !!}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex col-span-6 items-center justify-end mt-3">
                                        <div class="flex items-center">
                                            <button type="button" @click="Livewire.navigate('{{ route('mypage.inquiry.list', request()->query()) }}')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">목록</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="block col-span-full xl:col-auto mt-3 sm:mt-0 px-4 xl:px-0">
            <livewire:mypage.my-side />
        </div>
    </div>

    @once <x-confirm /> @endonce
    @once <x-alert /> @endonce
</main>
