<x-app-layout>
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center px-6 pt-8 mx-auto md:h-screen dark:bg-gray-900">
            <div class="flex items-center mb-3 justify-center text-lg font-semibold dark:text-white">
                @if (auth()->user()->status === 4)
                    휴면회원 이메일 인증
                @else
                    회원 이메일 인증
                @endif
            </div>
            <div class="w-full max-w-md mb-7 px-3 py-6 sm:p-6 bg-white rounded-md shadow dark:bg-gray-800">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div>
                        @if (auth()->user()->status === 4)
                            <label for="current_password" class="block text-sm font-medium text-gray-900 dark:text-white leading-6">오랫동안 미접속으로 인해 휴면회원으로 전환되셨습니다.<br>이메일 인증을 통해 휴면 상태를 변경해주세요.</label>
                        @else
                            <label for="current_password" class="block text-sm font-medium text-gray-900 dark:text-white leading-6">가입시 등록하신 이메일로 인증 메일이 발송되었습니다.<br>이메일을 받지 못하셨다면 재발송 버튼을 클릭해주세요.</label>
                        @endif
                    </div>
                    <button type="submit" onClick="document.getElementById('loadingScreen').classList.remove('hidden');" class="w-full mt-3 px-5 py-[7px] text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">인증 이메일 재발송</button>
                    <button type="button" @click="location.href='{{ route('profile.show') }}'" class="w-full mt-3 px-5 py-[7px] text-sm font-medium text-center text-white bg-teal-700 rounded-md hover:bg-teal-800 dark:bg-teal-600 dark:hover:bg-teal-700">프로필 설정</button>
                </form>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"  class="w-full mt-3 px-5 py-[7px] text-sm font-medium text-center text-white bg-red-700 rounded-md hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-700">로그아웃</button>
                </form>
            </div>
        </div>
    </main>
    <div class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90 flex hidden items-center justify-center font-medium text-gray-900 dark:text-white" id="loadingScreen">인증 메일 발송 중입니다. 잠시만 기다려주세요.</div>
</x-app-layout>
