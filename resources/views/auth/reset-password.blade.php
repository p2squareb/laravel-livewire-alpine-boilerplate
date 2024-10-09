<x-guest-layout>
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="{{ route('home') }}" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="/img/sm-logo.png" class="mr-4 h-11" alt="Sitename Logo">
                <span>{{ cache('config.basic')->basic->site_name }}</span>
            </a>

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
                <div class="w-full p-6 sm:p-8">
                    <h2 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">비밀번호 재설정</h2>
                    <form class="mt-8 space-y-5" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">이메일</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="이메일을 입력해주세요." required>
                            @error('email')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호</label>
                            <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="대문자+특수문자 포함 (8~16자리)" class="mb-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required>
                            <input type="password" name="password_confirm" id="password_confirm" value="{{ old('password_confirm') }}" placeholder="대문자+특수문자 포함 (8~16자리)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required>
                            @if ($errors->has('password') || $errors->has('password_confirm'))
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                    @if ($errors->has('password'))
                                        {{ $errors->first('password') }}
                                    @elseif($errors->has('password_confirm'))
                                        {{ $errors->first('password_confirm') }}
                                    @endif
                                </p>
                            @endif
                        </div>
                        <button type="submit" class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                            비밀번호 재설정
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-guest-layout>
