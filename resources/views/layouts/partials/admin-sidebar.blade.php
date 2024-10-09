
<aside :class="{ 'hidden': !leftSideMenu, 'lg:flex': true }" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width">
    <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-2 space-y-2">
                    <li>
                        <a href="/admin/dashboard" class="flex items-center p-2 text-base text-gray-900 rounded-md hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-[23px] h-[23px] text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Zm16 14a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2ZM4 13a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6Zm16-2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6Z"/>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li x-data="{ systemOpen: {{ Request::segment(2) == "system" ? 1: 0 }} }">
                        <button type="button" @click="systemOpen = !systemOpen" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-md group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-[23px] h-[23px] text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13v-2a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L14 4.757V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L4.929 6.343a1 1 0 0 0 0 1.414l.536.536L4.757 10H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535 1.707.707V20a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H20a1 1 0 0 0 1-1Z"/>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">시스템 설정</span>
                            <svg x-show="!systemOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-5 5-5-5"/>
                            </svg>
                            <svg x-show="systemOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 5-5 5 5"/>
                            </svg>
                        </button>
                        <ul x-show="systemOpen" :class="{'': systemOpen, 'hidden': !systemOpen}" class="space-y-2 py-2 hidden">
                            <li>
                                <a href="{{ route('admin.system.basic') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/system/basic') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">기본 환경설정</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.system.policy-terms') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/system/policy-terms') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">이용약관 / 개인정보처리방침</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.system.external') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/system/external') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">외부서비스 설정</a>
                            </li>
                        </ul>
                    </li>
                    <li x-data="{ userOpen: {{ Request::segment(2) == "user" ? 1 : 0 }} }">
                        <button type="button" @click="userOpen = !userOpen" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-md group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-[23px] h-[23px] text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">회원 관리</span>
                            <svg x-show="!userOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-5 5-5-5"/>
                            </svg>
                            <svg x-show="userOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 5-5 5 5"/>
                            </svg>
                        </button>
                        <ul x-show="userOpen" :class="{'': userOpen, 'hidden': !userOpen}" class="space-y-2 py-2 hidden">
                            <li>
                                <a href="{{ route('admin.user.list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ (request()->is('admin/user/list') || request()->is('admin/user/read*')) ? 'bg-gray-100 dark:bg-gray-700' : '' }}">회원 리스트</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.group-list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/user/group-list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">회원 그룹</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.prohibit-list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/user/prohibit-list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">정지회원 리스트</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.dormant-list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/user/dormant-list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">휴면회원 리스트</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.withdrawal-list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/user/withdrawal-list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">탈퇴회원 리스트</a>
                            </li>
                        </ul>
                    </li>
                    <li x-data="{ userOpen: {{ Request::segment(2) == "point" ? 1 : 0 }} }">
                        <button type="button" @click="userOpen = !userOpen" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-md group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-[23px] h-[23px] text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m8.032 12 1.984 1.984 4.96-4.96m4.55 5.272.893-.893a1.984 1.984 0 0 0 0-2.806l-.893-.893a1.984 1.984 0 0 1-.581-1.403V7.04a1.984 1.984 0 0 0-1.984-1.984h-1.262a1.983 1.983 0 0 1-1.403-.581l-.893-.893a1.984 1.984 0 0 0-2.806 0l-.893.893a1.984 1.984 0 0 1-1.403.581H7.04A1.984 1.984 0 0 0 5.055 7.04v1.262c0 .527-.209 1.031-.581 1.403l-.893.893a1.984 1.984 0 0 0 0 2.806l.893.893c.372.372.581.876.581 1.403v1.262a1.984 1.984 0 0 0 1.984 1.984h1.262c.527 0 1.031.209 1.403.581l.893.893a1.984 1.984 0 0 0 2.806 0l.893-.893a1.985 1.985 0 0 1 1.403-.581h1.262a1.984 1.984 0 0 0 1.984-1.984V15.7c0-.527.209-1.031.581-1.403Z"/>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">포인트 관리</span>
                            <svg x-show="!userOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-5 5-5-5"/>
                            </svg>
                            <svg x-show="userOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 5-5 5 5"/>
                            </svg>
                        </button>
                        <ul x-show="userOpen" :class="{'': userOpen, 'hidden': !userOpen}" class="space-y-2 py-2 hidden">
                            <li>
                                <a href="{{ route('admin.point.set') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/point/set') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">포인트 설정</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.point.list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/point/list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">포인트 내역</a>
                            </li>
                        </ul>
                    </li>
                    <li x-data="{ boardOpen: {{ Request::segment(2) == "board" ? 1: 0 }} }">
                        <button type="button" @click="boardOpen = !boardOpen" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-md group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-[23px] h-[23px] text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7h1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h11.5M7 14h6m-6 3h6m0-10h.5m-.5 3h.5M7 7h3v3H7V7Z"/>
                            </svg>

                            <span class="flex-1 ml-3 text-left whitespace-nowrap">게시판 관리</span>
                            <svg x-show="!boardOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-5 5-5-5"/>
                            </svg>
                            <svg x-show="boardOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 5-5 5 5"/>
                            </svg>
                        </button>
                        <ul x-show="boardOpen" :class="{'': boardOpen, 'hidden': !boardOpen}" class="space-y-2 py-2 hidden">
                            <li>
                                <a href="{{ route('admin.board.list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ (request()->is('admin/board/list') || request()->is('admin/board/create') || request()->is('admin/board/update*')) ? 'bg-gray-100 dark:bg-gray-700' : '' }}">게시판 리스트</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.board.write.list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/board/write/list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">게시글 관리</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.board.comment.list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/board/comment/list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">댓글 관리</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.board.report.list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ request()->is('admin/board/report/list') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">신고 내역</a>
                            </li>
                        </ul>
                    </li>
                    <li x-data="{ boardOpen: {{ Request::segment(2) == "inquiry" ? 1: 0 }} }">
                        <button type="button" @click="boardOpen = !boardOpen" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-md group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                            <svg class="w-[20px] h-[20px] text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" version="1.0" viewBox="0 0 64 64" preserveAspectRatio="xMidYMid meet"><script xmlns=""/>
                                <g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none">
                                    <path d="M58 624 c-52 -28 -58 -55 -58 -263 0 -120 4 -192 10 -196 6 -4 39 16 73 44 34 28 65 51 69 51 5 0 8 -14 8 -30 0 -17 7 -46 15 -66 21 -51 61 -64 202 -64 l118 -1 60 -49 c33 -28 64 -49 70 -47 6 2 11 81 13 205 2 169 0 207 -13 233 -18 34 -67 59 -115 59 -23 0 -30 4 -30 20 0 38 -28 89 -59 104 -42 22 -323 22 -363 0z m362 -44 c18 -18 20 -33 20 -127 0 -96 -2 -109 -22 -130 -20 -22 -28 -23 -153 -23 l-131 0 -41 -35 c-23 -19 -44 -35 -47 -35 -3 0 -6 74 -6 165 0 218 -13 205 200 205 147 0 162 -2 180 -20z m160 -140 c19 -19 20 -33 20 -201 l0 -180 -48 40 -48 41 -132 0 c-119 0 -134 2 -152 20 -13 13 -20 33 -20 59 l0 40 103 5 c162 8 232 19 232 36 0 10 -12 16 -33 18 -43 4 -41 34 3 42 38 7 40 34 3 38 -24 3 -28 8 -28 33 0 27 2 29 40 29 27 0 47 -7 60 -20z"/>
                                    <path d="M194 535 c-26 -26 -29 -55 -7 -62 7 -3 17 7 23 21 11 30 47 36 57 9 4 -11 -3 -23 -20 -37 -28 -23 -35 -50 -16 -62 15 -9 79 61 79 86 0 27 -43 70 -70 70 -11 0 -32 -11 -46 -25z"/>
                                    <path d="M224 369 c-10 -17 13 -36 27 -22 12 12 4 33 -11 33 -5 0 -12 -5 -16 -11z"/>
                                    <path d="M265 229 c-15 -24 16 -30 141 -27 107 3 129 6 129 18 0 12 -23 15 -132 18 -89 2 -134 -1 -138 -9z"/>
                                </g>
                                <script xmlns=""/>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">1:1 문의 관리</span>
                            <svg x-show="!boardOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 9-5 5-5-5"/>
                            </svg>
                            <svg x-show="boardOpen" class="w-[21px] h-[21px] mb-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 15 5-5 5 5"/>
                            </svg>
                        </button>
                        <ul x-show="boardOpen" :class="{'': boardOpen, 'hidden': !boardOpen}" class="space-y-2 py-2 hidden">
                            <li>
                                <a href="{{ route('admin.inquiry.list') }}" wire:navigate
                                   class="text-sm text-gray-900 rounded-md flex items-center p-2 group hover:bg-gray-100 transition duration-75 pl-11 dark:text-gray-200 dark:hover:bg-gray-700
                                   {{ (request()->is('admin/inquiry/list') || request()->is('admin/inquiry/read*')) ? 'bg-gray-100 dark:bg-gray-700' : '' }}">1:1 문의 내역</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="pt-2 space-y-2">
                    <a href="https://github.com/themesberg/flowbite-admin-dashboard" target="_blank" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-md hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-.3 5.6 1.3 5.6 3.6zm-31.1-4.5c-.7 2 1.3 4.3 4.3 4.9 2.6 1 5.6 0 6.2-2s-1.3-4.3-4.3-5.2c-2.6-.7-5.5.3-6.2 2.3zm44.2-1.7c-2.9.7-4.9 2.6-4.6 4.9.3 2 2.9 3.3 5.9 2.6 2.9-.7 4.9-2.6 4.6-4.6-.3-1.9-3-3.2-5.9-2.9zM244.8 8C106.1 8 0 113.3 0 252c0 110.9 69.8 205.8 169.5 239.2 12.8 2.3 17.3-5.6 17.3-12.1 0-6.2-.3-40.4-.3-61.4 0 0-70 15-84.7-29.8 0 0-11.4-29.1-27.8-36.6 0 0-22.9-15.7 1.6-15.4 0 0 24.9 2 38.6 25.8 21.9 38.6 58.6 27.5 72.9 20.9 2.3-16 8.8-27.1 16-33.7-55.9-6.2-112.3-14.3-112.3-110.5 0-27.5 7.6-41.3 23.6-58.9-2.6-6.5-11.1-33.3 2.6-67.9 20.9-6.5 69 27 69 27 20-5.6 41.5-8.5 62.8-8.5s42.8 2.9 62.8 8.5c0 0 48.1-33.6 69-27 13.7 34.7 5.2 61.4 2.6 67.9 16 17.7 25.8 31.5 25.8 58.9 0 96.5-58.9 104.2-114.8 110.5 9.2 7.9 17 22.9 17 46.4 0 33.7-.3 75.4-.3 83.6 0 6.5 4.6 14.4 17.3 12.1C428.2 457.8 496 362.9 496 252 496 113.3 383.5 8 244.8 8zM97.2 352.9c-1.3 1-1 3.3.7 5.2 1.6 1.6 3.9 2.3 5.2 1 1.3-1 1-3.3-.7-5.2-1.6-1.6-3.9-2.3-5.2-1zm-10.8-8.1c-.7 1.3.3 2.9 2.3 3.9 1.6 1 3.6.7 4.3-.7.7-1.3-.3-2.9-2.3-3.9-2-.6-3.6-.3-4.3.7zm32.4 35.6c-1.6 1.3-1 4.3 1.3 6.2 2.3 2.3 5.2 2.6 6.5 1 1.3-1.3.7-4.3-1.3-6.2-2.2-2.3-5.2-2.6-6.5-1zm-11.4-14.7c-1.6 1-1.6 3.6 0 5.9 1.6 2.3 4.3 3.3 5.6 2.3 1.6-1.3 1.6-3.9 0-6.2-1.4-2.3-4-3.3-5.6-2z"/></svg>
                        <span class="ml-3">GitHub Repository</span>
                    </a>
                    <a href="https://flowbite.com/docs/getting-started/introduction/" target="_blank" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-md hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                        <span class="ml-3">Flowbite Docs</span>
                    </a>
                    <a href="https://flowbite.com/docs/components/alerts/" target="_blank" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-md hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        <span class="ml-3">Components</span>
                    </a>
                    <a href="https://flowbite-admin-dashboard.vercel.app/" target="_blank" class="flex items-center p-2 text-base text-gray-900 transition duration-75 rounded-md hover:bg-gray-100 group dark:text-gray-200 dark:hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-3">Support</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</aside>
<div :class="{ 'hidden': !leftSideMenu, 'lg:hidden': true }" class="fixed inset-0 z-10 bg-gray-900/50 dark:bg-gray-900/90"></div>
