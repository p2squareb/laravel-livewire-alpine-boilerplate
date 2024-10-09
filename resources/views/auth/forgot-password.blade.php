<x-guest-layout>
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="{{ route('home') }}" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="/img/sm-logo.png" class="mr-4 h-11" alt="Sitename Logo">
                <span>{{ cache('config.basic')->basic->site_name }}</span>
            </a>

            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
                <div class="w-full p-6 sm:p-8">
                    <h2 class="mb-3 text-xl font-bold text-gray-900 dark:text-white">
                        비밀번호 찾기
                    </h2>
                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        가입 시 등록하신 이메일 주소를 입력해 주세요. 비밀번호 재설정 링크를 보내드립니다.
                    </p>
                    <form class="mt-8 space-y-5" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">이메일</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-primary-500" placeholder="이메일 주소를 입력해주세요.">
                            @error('email')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                        </div>
                        <button type="submit" onClick="document.getElementById('loadingScreen').classList.remove('hidden');" class="w-full mt-5 px-5 py-[7px] text-base font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                            비밀번호 재설정 링크 받기
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <div class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90 flex hidden items-center justify-center font-medium text-gray-900 dark:text-white" id="loadingScreen">메일 발송 중입니다. 잠시만 기다려주세요.</div>
</x-guest-layout>
