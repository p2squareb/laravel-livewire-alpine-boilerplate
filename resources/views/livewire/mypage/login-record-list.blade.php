<main>
    <div class="grid grid-cols-1 px-0 pt-6 xl:grid-cols-4 xl:gap-3 dark:bg-gray-900">
        <div class="col-span-3">
            <div class="px-4 xl:px-0">
                <div class="p-3 sm:p-5 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mb-3">
                        <h1 class="text-xl font-semibold text-gray-900 dark:text-white"><a href="{{ route('mypage.login-record.list') }}" wire:navigate>로그인 기록</a></h1>
                    </div>
                    <div class="flex flex-col mt-3">
                        <div class="overflow-x-auto rounded-md">
                            <div class="overflow-hidden shadow sm:rounded-md min-w-full" wire:loading.class.delay="opacity-50">

                                @foreach($loginRecordList as $key => $login)
                                    <div class="justify-start p-3 {{ ($key % 2 === 1) ? 'bg-white dark:bg-gray-800' : 'bg-gray-50 dark:bg-gray-700' }}">
                                        <div class="items-center justify-center text-sm text-gray-900 dark:text-white mb-1">
                                            {{ $login->login_at }}
                                        </div>
                                        <div class="items-center justify-center text-sm text-gray-900 dark:text-white mb-1">
                                            <span class="mr-2">{{ $login->ip_address }}</span>
                                            @if (!is_null($login->social_type))
                                                <span>SNS : {{ $login->social_type }}</span>
                                            @endif
                                        </div>
                                        <div class="items-center justify-center text-sm text-gray-900 dark:text-white">
                                            {{ $login->user_agent }}
                                        </div>
                                    </div>
                                @endforeach
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
</main>

