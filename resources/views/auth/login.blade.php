<x-guest-layout>
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="{{ route('home') }}" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="/img/sm-logo.png" class="mr-4 h-11" alt="Sitename Logo">
                <span>{{ cache('config.basic')->basic->site_name }}</span>
            </a>

            <div class="w-full max-w-md p-6 sm:p-8 bg-white rounded-md shadow dark:bg-gray-800">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">이메일</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required placeholder="이메일을 입력해주세요.">
                        @error('email')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                    </div>
                    <div class="mt-5">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">비밀번호</label>
                        <input type="password" name="password" id="password" placeholder="비밀번호를 입력해주세요." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required>
                        @error('password')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                        @error('auth-failed')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                    </div>
                    <div class="flex items-start mt-5">
                        <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" name="remember" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="remember" class="font-medium text-gray-900 dark:text-white">로그인 상태 유지</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="ml-auto text-sm text-blue-700 hover:underline dark:text-blue-500">비밀번호 찾기</a>
                    </div>
                    <button type="submit" class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">로그인하기</button>
                </form>
                @if (cache('config.external')->socialLogin->use_sns == '1')
                    <div class="mt-5 text-sm font-medium text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-500 rounded-md py-3 px-4">
                        <label class="block mb-3 text-sm font-bold text-gray-900 dark:text-white">SNS 간편 로그인</label>
                        <div class="flex w-full justify-between">
                            <a href="/signup/naver?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(30, 200, 0);"><img alt="naver" src="/img/icon/naver-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/kakao?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(249, 224, 0);"><img alt="kakao" src="/img/icon/kakao-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/facebook?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(24, 119, 242);"><img alt="facebook" src="/img/icon/facebook-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/google?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(255, 255, 255); border: 1px solid rgb(228, 229, 237);"><img alt="google" src="/img/icon/google-logo.png" class="w-7 h-7"></a>
                            <a href="/signup/apple?next_page=%2F" class="p-2 sm:p-3 rounded" style="background-color: rgb(0, 0, 0);"><img alt="apple" src="/img/icon/apple-logo.png" class="w-7 h-7"></a>
                        </div>
                    </div>
                    <button type="button" @click="location.href='{{ route('register') }}'" class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700">회원가입</button>
                @else
                    <button type="button" @click="location.href='{{ route('register') }}'" class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700">회원가입</button>
                @endif


            </div>
        </div>
    </main>
</x-guest-layout>
