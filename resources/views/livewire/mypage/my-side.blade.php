<div>
    <div class="p-3 mb-3 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="items-center">
            <button type="button" @click="Livewire.navigate('{{ route('mypage.overview') }}')" class="m-1 py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">마이페이지</button>
            <button type="button" @click="Livewire.navigate('{{ route('mypage.userinfo') }}')" class="m-1 py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">회원정보</button>
            <button type="button" @click="Livewire.navigate('{{ route('mypage.login-record.list') }}')" class="m-1 py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">로그인 기록</button>
            <button type="button" @click="Livewire.navigate('{{ route('mypage.overview') }}')" class="m-1 py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">로그인 관리</button>
            <button type="button" @click="Livewire.navigate('{{ route('mypage.write.list') }}')" class="m-1 py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">활동기록</button>
            <button type="button" @click="Livewire.navigate('{{ route('mypage.inquiry.list') }}')" class="m-1 py-[7px] px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-300 hover:bg-gray-100 hover:text-blue-700 focus:z-10 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">1:1 문의내역</button>
        </div>
    </div>

    <div class="border border-gray-200 rounded-md shadow-sm dark:border-gray-700">
        <img class="h-auto" src="https://flowbite.com/docs/images/examples/image-1@2x.jpg" alt="image description">
    </div>
</div>

