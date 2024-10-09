<header>
    <nav class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 py-3 px-4">
        <div class="flex justify-between items-center max-w-screen-xl mx-auto">
            <div class="flex justify-start items-center">
                <a href="{{ route('home') }}" class="flex mr-14">
                    <img src="/img/sm-logo.png" class="mr-3 h-8" alt="FlowBite Logo" />
                    <span class="self-center hidden sm:flex text-2xl font-semibold whitespace-nowrap dark:text-white">{{ cache('config.basic')->basic->site_name }}</span>
                </a>

                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1">
                    <ul class="flex flex-col mt-4 space-x-6 font-medium lg:flex-row xl:space-x-8 lg:mt-0">
                        <li>
                            <a href="{{ route('home') }}" wire:navigate class="block rounded text-blue-700 dark:text-blue-500" aria-current="page">Main</a>
                        </li>
                        <li>
                            <a href="{{ route('write.list', ['tableId' => 'test']) }}" wire:navigate class="block text-gray-700 hover:text-blue-700 dark:text-gray-400 dark:hover:text-white">Board</a>
                        </li>
                        <li>
                            <a href="{{ route('mypage.overview') }}" wire:navigate class="block text-gray-700 hover:text-blue-700 dark:text-gray-400 dark:hover:text-white">Profile</a>
                        </li>
                        <li>
                            <a href="#" class="block text-gray-700 hover:text-blue-700 dark:text-gray-400 dark:hover:text-white">Settings</a>
                        </li>
                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex justify-between items-center py-2 pr-4 pl-3 w-full font-medium text-gray-700 border-b border-gray-100 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-gray-400 dark:hover:text-white dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">Dropdown <svg class="ml-1 w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg></button>

                            <div id="dropdownNavbar" class="hidden z-20 w-44 font-normal bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Item 1</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Item 2</a>
                                    </li>
                                    <li>
                                        <a href="#" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Item 3</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-between items-center lg:order-2">

                <button type="button" @click="darkMode = !darkMode" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-md text-sm p-2.5">
                    <svg x-show="!darkMode" :class="{'hidden' : darkMode, '' : !darkMode}" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg x-show="darkMode" :class="{'hidden' : !darkMode, '' : darkMode}" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>

                @if (Auth::check())
                    <button type="button" data-dropdown-toggle="notification-dropdown" class="relative inline-flex items-center p-2 text-gray-500 rounded-md hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                        <span class="sr-only">View notifications</span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                        @if (count($notifications) > 0)
                            <span class="sr-only">Notifications Count</span>
                            <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-1 dark:border-gray-900">
                                {{ count($notifications) }}
                            </div>
                        @endif
                    </button>
                    <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
                        <div>
                            @forelse($notifications as $notification)
                                <div :key="{{ $notification->id }}" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-600">
                                    <div class="flex-shrink-0">
                                        @if ($notification->user->profile_photo_path)
                                            <img class="w-10 h-10 rounded-full" src="/storage/profiles/{{ $notification->user->profile_photo_path }}" alt="{{ $notification->user->nickname }}'s avatar">
                                        @else
                                            <svg class="w-10 h-10 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="pl-3 w-full">
                                        <div wire:click="markAsRead({{ $notification->id }}, 'link', '{{ $notification->refer_url }}')" class="text-gray-700 font-normal text-sm mb-1 dark:text-gray-300 cursor-pointer">
                                            {!! str_replace($notification->send_nickname, '<span class="font-semibold text-gray-900 dark:text-white">' . $notification->send_nickname . '</span>', $notification->message) !!}
                                        </div>
                                        <div class="flex justify-end text-xs font-medium text-blue-700 dark:text-blue-400">
                                            <p>{{ humanReadableDate($notification->created_at, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-800 dark:border-gray-600">
                                    <div class="w-full">
                                        <div class="text-gray-500 font-normal text-sm dark:text-gray-400">알림 내역이 없습니다.</div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        @if (count($notifications) > 0)
                            <div class="flex items-center justify-between py-3 px-6 text-sm font-normal text-center text-gray-900 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-800">
                                <div wire:click="markAsRead({{ $notification->id }}, 'all_view')" class="inline-flex items-center">
                                    <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                                    전체보기
                                </div>
                                <div wire:click="markAsRead({{ $notification->id }}, 'all_read')" class="inline-flex items-center cursor-pointer">
                                    <svg class="mr-2 w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="m4 15.6 3.055-3.056A4.913 4.913 0 0 1 7 12.012a5.006 5.006 0 0 1 5-5c.178.009.356.027.532.054l1.744-1.744A8.973 8.973 0 0 0 12 5.012c-5.388 0-10 5.336-10 7A6.49 6.49 0 0 0 4 15.6Z"/>
                                        <path d="m14.7 10.726 4.995-5.007A.998.998 0 0 0 18.99 4a1 1 0 0 0-.71.305l-4.995 5.007a2.98 2.98 0 0 0-.588-.21l-.035-.01a2.981 2.981 0 0 0-3.584 3.583c0 .012.008.022.01.033.05.204.12.402.211.59l-4.995 4.983a1 1 0 1 0 1.414 1.414l4.995-4.983c.189.091.386.162.59.211.011 0 .021.007.033.01a2.982 2.982 0 0 0 3.584-3.584c0-.012-.008-.023-.011-.035a3.05 3.05 0 0 0-.21-.588Z"/>
                                        <path d="m19.821 8.605-2.857 2.857a4.952 4.952 0 0 1-5.514 5.514l-1.785 1.785c.767.166 1.55.25 2.335.251 6.453 0 10-5.258 10-7 0-1.166-1.637-2.874-2.179-3.407Z"/>
                                    </svg>
                                    모두 읽음
                                </div>
                            </div>
                        @endif
                    </div>

                    <button type="button" class="flex mx-3 text-sm bg-gray-300 dark:bg-gray-800 rounded-full md:mr-0 flex-shrink-0" id="userMenuDropdownButton" aria-expanded="false" data-dropdown-toggle="userMenuDropdown">
                        @if (auth()->user()->profile_photo_path)
                            <img class="w-8 h-8 rounded-full" src="/storage/profiles/{{ auth()->user()->profile_photo_path }}" alt="{{ auth()->user()->nickname }}'s avatar">
                        @else
                            <svg class="w-8 h-8 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                            </svg>
                        @endif
                    </button>

                    <div class="hidden z-50 my-4 w-52 list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="userMenuDropdown">
                        <div class="py-3 px-4">
                            <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ auth()->user()->nickname }}</span>
                            <span class="block text-sm font-light text-gray-700 truncate dark:text-gray-300">{{ auth()->user()->email }}</span>
                        </div>
                        <ul class="py-1 font-light" aria-labelledby="userMenuDropdownButton">
                            <li>
                                <a href="{{ route('profile.show') }}" class="flex py-2 px-4 text-sm font-semibold text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg class="w-5 h-5 text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    </svg>
                                    <span class="dark:text-gray-100">프로필 설정</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('mypage.overview') }}" class="flex py-2 px-4 text-sm font-semibold text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                    <svg class="w-5 h-5 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M5.024 3.783A1 1 0 0 1 6 3h12a1 1 0 0 1 .976.783L20.802 12h-4.244a1.99 1.99 0 0 0-1.824 1.205 2.978 2.978 0 0 1-5.468 0A1.991 1.991 0 0 0 7.442 12H3.198l1.826-8.217ZM3 14v5a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-5h-4.43a4.978 4.978 0 0 1-9.14 0H3Zm5-7a1 1 0 0 1 1-1h6a1 1 0 1 1 0 2H9a1 1 0 0 1-1-1Zm0 2a1 1 0 0 0 0 2h8a1 1 0 1 0 0-2H8Z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="dark:text-gray-100">마이페이지</span>
                                </a>
                            </li>
                            @if (auth()->user()->group_level >= 11)
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="flex py-2 px-4 text-sm font-semibold text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                        <svg class="w-5 h-5 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Zm16 14a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2ZM4 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6Zm16-2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6Z"/>
                                        </svg>
                                        <span class="dark:text-gray-100">관리자 페이지</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                        <ul class="py-1 font-light text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();" class="flex items-center py-2 px-4 text-sm font-semibold hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-white">
                                        <svg class="w-5 h-5 text-gray-800 dark:text-white mr-1 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v9m-5 0H5a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1h-2M8 9l4-5 4 5m1 8h.01"/>
                                        </svg>
                                        <span class="dark:text-gray-100">로그아웃</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="p-2 text-gray-500 rounded-md hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.0" width="24px" height="24px" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                            <g transform="translate(0,512) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                                <path d="M2380 4943 c-511 -45 -921 -413 -1016 -910 -20 -106 -22 -290 -4 -393 80 -465 439 -828 906 -916 119 -22 355 -15 464 14 245 65 450 195 597 377 111 138 179 272 225 443 29 111 36 346 14 466 -75 398 -346 718 -724 856 -129 47 -333 75 -462 63z"/>
                                <path d="M3636 2715 c-134 -37 -295 -157 -316 -236 -28 -103 47 -199 155 -199 53 0 89 16 125 55 14 15 48 38 75 51 49 23 58 24 310 24 290 0 307 -4 374 -71 75 -74 71 -24 71 -885 l0 -772 -28 -53 c-36 -69 -95 -114 -167 -129 -36 -8 -136 -10 -283 -8 -252 4 -271 8 -343 72 -59 54 -95 69 -151 64 -122 -12 -183 -144 -115 -247 32 -48 130 -124 202 -156 102 -45 144 -50 445 -50 267 0 290 1 355 22 194 62 341 215 390 408 22 88 22 1598 0 1694 -47 200 -216 369 -416 416 -86 20 -609 20 -683 0z"/>
                                <path d="M2055 2224 c-496 -50 -1016 -203 -1438 -421 -122 -64 -174 -112 -215 -201 l-27 -57 0 -475 c0 -474 0 -475 23 -532 46 -113 159 -205 281 -228 46 -8 2341 -16 2341 -7 0 1 -7 36 -16 77 -15 75 -12 166 7 218 7 19 0 31 -55 85 -69 67 -119 155 -137 236 l-10 49 -177 5 c-239 7 -317 33 -427 142 -207 204 -187 540 42 716 107 82 148 93 371 97 150 3 192 6 192 17 0 37 45 150 81 205 23 33 40 63 38 64 -2 2 -64 9 -138 15 -176 15 -573 12 -736 -5z"/>
                                <path d="M3225 2026 c-56 -25 -88 -70 -93 -129 -6 -70 7 -93 107 -192 45 -44 81 -83 81 -87 0 -5 -186 -8 -414 -8 -412 0 -413 0 -446 -22 -50 -34 -72 -71 -77 -125 -5 -59 25 -117 77 -147 33 -20 54 -21 448 -26 l413 -5 -81 -80 c-96 -94 -110 -118 -110 -182 0 -88 68 -153 160 -153 22 0 53 6 68 14 32 18 485 472 501 503 16 31 14 109 -3 141 -21 39 -465 477 -503 496 -39 19 -87 20 -128 2z"/>
                            </g>
                        </svg>
                    </a>
                @endif

                <button type="button" id="toggleMobileMenuButton" data-collapse-toggle="toggleMobileMenu" class="items-center p-2 text-gray-500 rounded-md md:ml-2 lg:hidden hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700">
                    <span class="sr-only">Open menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        </div>
    </nav>
    <nav class="bg-white dark:bg-gray-900">

        <ul id="toggleMobileMenu" class="hidden flex-col mt-0 pt-16 w-full text-sm font-medium lg:hidden">
            <li class="block border-b dark:border-gray-700">
                <a href="#" class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0" aria-current="page">Main</a>
            </li>
            <li class="block border-b dark:border-gray-700">
                <a href="#" class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Board</a>
            </li>
            <li class="block border-b dark:border-gray-700">
                <a href="#" class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Profile</a>
            </li>
            <li class="block border-b dark:border-gray-700">
                <a href="#" class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Settings</a>
            </li>
            <li class="block border-b dark:border-gray-700">
                <button type="button" data-collapse-toggle="dropdownMobileNavbar" class="flex justify-between items-center py-3 px-4 w-full text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Dropdown <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
                <ul id="dropdownMobileNavbar" class="hidden">
                    <li class="block border-t border-b dark:border-gray-700">
                        <a href="#" class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Item 1</a>
                    </li>
                    <li class="block border-b dark:border-gray-700">
                        <a href="#" class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Item 2</a>
                    </li>
                    <li class="block">
                        <a href="#" class="block py-3 px-4 text-gray-900 lg:py-0 dark:text-white lg:hover:underline lg:px-0">Item 3</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

