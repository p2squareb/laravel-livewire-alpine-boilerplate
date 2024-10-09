<x-guest-layout>
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="/" class="flex items-center justify-center mb-5 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="/img/sm-logo.png" class="mr-4 h-11" alt="FlowBite Logo">
                <span>{{ cache('config.basic')->basic->site_name }}</span>
            </a>
            <div class="w-full max-w-md p-6 sm:p-8 bg-white rounded-md shadow dark:bg-gray-800">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">딱 이것만 체크하면 가입완료!</h2>
                <form class="mt-5 space-y-5" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">이메일</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="이메일을 입력해주세요." required>
                        @error('email')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                    </div>
                    <div>
                        <label for="nickname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">닉네임</label>
                        <input type="text" name="nickname" id="nickname" value="{{ old('nickname') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="닉네임을 입력해주세요." required>
                        @error('nickname')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
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
                    <div>
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="terms" id="terms" class="w-4 h-4 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-900 dark:text-white"><a href="{{ route('site-policy', ['id' => 'terms']) }}" target="_blank" class="text-blue-700 hover:underline dark:text-blue-500">서비스 이용약관</a>에 동의합니다.</label>
                            </div>
                        </div>
                        <div class="flex items-start mt-2">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="privacy" id="privacy" class="w-4 h-4 border-gray-300 rounded bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="privacy" class="font-medium text-gray-900 dark:text-white"><a href="{{ route('site-policy', ['id' => 'policy']) }}" target="_blank" class="text-blue-700 hover:underline dark:text-blue-500">개인정보 수집/이용</a>에 동의합니다.</label>
                            </div>
                        </div>
                        @if ($errors->has('terms') || $errors->has('privacy'))
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                                @if ($errors->has('terms'))
                                    {{ $errors->first('terms') }}
                                @elseif($errors->has('privacy'))
                                    {{ $errors->first('privacy') }}
                                @endif
                            </p>
                        @endif
                    </div>
                    <button type="submit" onClick="document.getElementById('loadingScreen').classList.remove('hidden');" class="w-full px-5 py-[7px] text-base font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">회원가입</button>
                    <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        이미 계정을 가지고 계신가요? <a href="{{ route('login') }}" class="text-blue-700 hover:underline dark:text-blue-500">로그인하러 가기</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <div class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90 flex hidden items-center justify-center font-medium text-gray-900 dark:text-white" id="loadingScreen">인증 메일 발송 중입니다. 잠시만 기다려주세요.</div>
</x-guest-layout>
