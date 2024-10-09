@props(['id', 'svg', 'idx'])

@php
    $id = $id . $svg . '-' . $idx;
@endphp

@if ($svg === 'wrt')
    <button type="button" class="inline-flex text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700" data-dropdown-toggle="ddReportMenu-{{ $id }}" data-dropdown-placement="right-end">
        <svg class="w-4 h-4 mr-1 -ml-1" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
            <g transform="translate(0,24) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                <path d="M110 220 c0 -11 5 -20 10 -20 6 0 10 9 10 20 0 11 -4 20 -10 20 -5 0 -10 -9 -10 -20z"></path>
                <path d="M50 212 c0 -12 19 -26 26 -19 2 2 -2 10 -11 17 -9 8 -15 8 -15 2z"></path>
                <path d="M170 205 c-8 -9 -8 -15 -2 -15 12 0 26 19 19 26 -2 2 -10 -2 -17 -11z"></path>
                <path d="M70 160 c-15 -15 -20 -33 -20 -70 l0 -50 70 0 70 0 0 50 c0 59 -24 90 -70 90 -17 0 -39 -9 -50 -20z"></path>
                <path d="M15 160 c3 -5 11 -10 16 -10 6 0 7 5 4 10 -3 6 -11 10 -16 10 -6 0 -7 -4 -4 -10z"></path>
                <path d="M205 160 c-3 -5 -2 -10 4 -10 5 0 13 5 16 10 3 6 2 10 -4 10 -5 0 -13 -4 -16 -10z"></path>
                <path d="M30 15 c0 -12 17 -15 90 -15 73 0 90 3 90 15 0 12 -17 15 -90 15 -73 0 -90 -3 -90 -15z"></path>
            </g>
        </svg>
        신고
    </button>
    <div id="ddReportMenu-{{ $id }}" class="z-10 hidden bg-gray-100 rounded-md shadow w-55 dark:bg-gray-700">
        <div class="inline-flex p-3 text-sm space-x-3 text-gray-700 dark:text-gray-200" aria-labelledby="ddReportMenuBtn-{{ $id }}">
            <div class="text-center">
                <button type="button" @click="$dispatch('open-confirm', {type: 'single-write-report', link: '', message: '음란물, 게시물 신고, 불법촬영물, 홍보, 혐오,<br>허위 신고나 신고 사유와 맞지 않는 신고는<br>답변되지 않을 수 있으며 차단될 수 있습니다.<br>해당 게시물에 대한 신고를 진행하시겠습니까?'})" wire:click.prevent="$set('writeReport', '음란물')" class="border border-gray-600 hover:text-white hover:bg-red-600 focus:outline-none font-medium rounded-md text-sm px-3 py-2 text-center inline-flex items-center dark:border-gray-500 dark:hover:bg-red-600">
                    <svg class="w-11 h-11" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 128 128">
                        <g transform="translate(0,128) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                            <path d="M500 1264 c-111 -23 -224 -86 -311 -173 -251 -252 -252 -650 0 -901 253 -252 649 -253 901 0 253 252 253 647 0 901 -155 156 -374 220 -590 173z m275 -59 c263 -67 445 -298 445 -565 0 -274 -201 -519 -468 -571 -81 -15 -208 -7 -293 20 -169 53 -318 203 -372 376 -31 99 -31 252 1 352 27 86 105 206 170 263 56 49 171 108 244 126 73 17 202 17 273 -1z"/>
                            <path d="M725 898 c-76 -28 -125 -97 -125 -174 0 -80 68 -166 143 -181 15 -3 27 -8 27 -10 0 -3 -25 -41 -56 -84 l-55 -79 69 0 69 0 93 140 c83 125 94 147 98 194 9 113 -61 194 -175 202 -32 2 -71 -1 -88 -8z m128 -130 c39 -45 2 -118 -60 -118 -30 0 -73 42 -73 72 0 69 87 99 133 46z"/>
                            <path d="M362 876 c-35 -13 -65 -26 -68 -28 -2 -3 2 -24 9 -49 14 -47 22 -50 80 -36 l27 7 0 -200 0 -200 60 0 60 0 0 265 0 265 -52 -1 c-30 0 -81 -10 -116 -23z"/>
                        </g>
                    </svg>
                </button>
                <p class="mt-3">음란물</p>
            </div>
            <div class="text-center">
                <button type="button" @click="$dispatch('open-confirm', {type: 'single-write-report', link: '', message: '음란물, 게시물 신고, 불법촬영물, 홍보, 혐오,<br>허위 신고나 신고 사유와 맞지 않는 신고는<br>답변되지 않을 수 있으며 차단될 수 있습니다.<br>해당 게시물에 대한 신고를 진행하시겠습니까?'})" wire:click.prevent="$set('writeReport', '게시물 신고')" class="border border-gray-600 hover:text-white hover:bg-red-600 focus:outline-none font-medium rounded-md text-sm px-3 py-2 text-center inline-flex items-center dark:border-gray-500 dark:hover:bg-red-600">
                    <svg class="w-11 h-11" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 128 128">
                        <g transform="translate(0,128) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                            <path d="M490 1234 c-212 -55 -391 -236 -445 -449 -19 -76 -19 -214 0 -290 54 -214 232 -395 443 -451 74 -19 230 -19 304 0 209 56 387 234 444 444 20 74 20 230 0 304 -30 110 -75 188 -161 274 -87 88 -177 140 -290 169 -74 19 -222 18 -295 -1z m252 -105 c226 -47 398 -259 398 -489 0 -131 -53 -254 -149 -351 -199 -199 -503 -199 -702 0 -199 199 -199 503 0 702 123 123 287 173 453 138z"/>
                            <path d="M513 1046 c-107 -35 -204 -120 -256 -225 -30 -62 -32 -71 -32 -181 0 -110 2 -119 32 -181 42 -84 118 -160 202 -202 62 -30 71 -32 181 -32 110 0 118 1 183 33 85 42 157 115 200 201 30 62 32 71 32 181 0 110 -2 119 -32 181 -43 86 -115 159 -200 201 -60 29 -77 33 -167 35 -65 2 -116 -2 -143 -11z m177 -126 c11 -11 20 -32 20 -47 0 -74 -31 -337 -41 -349 -15 -18 -43 -18 -58 0 -10 12 -41 275 -41 349 0 36 32 67 70 67 17 0 39 -9 50 -20z m-8 -487 c22 -20 23 -51 1 -75 -32 -36 -103 -12 -103 35 0 49 64 75 102 40z"/>
                        </g>
                    </svg>
                </button>
                <p class="mt-3">게시물 신고</p>
            </div>
            <div class="text-center">
                <button type="button" @click="$dispatch('open-confirm', {type: 'single-write-report', link: '', message: '음란물, 게시물 신고, 불법촬영물, 홍보, 혐오,<br>허위 신고나 신고 사유와 맞지 않는 신고는<br>답변되지 않을 수 있으며 차단될 수 있습니다.<br>해당 게시물에 대한 신고를 진행하시겠습니까?'})" wire:click.prevent="$set('writeReport', '불법촬영물')" class="border border-gray-600 hover:text-white hover:bg-red-600 focus:outline-none font-medium rounded-md text-sm px-3 py-2 text-center inline-flex items-center dark:border-gray-500 dark:hover:bg-red-600">
                    <svg class="w-11 h-11 lucide lucide-camera-off" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="2" x2="22" y1="2" y2="22"/><path d="M7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16"/><path d="M9.5 4h5L17 7h3a2 2 0 0 1 2 2v7.5"/><path d="M14.121 15.121A3 3 0 1 1 9.88 10.88"/></svg>
                </button>
                <p class="mt-3">불법촬영물</p>
            </div>
        </div>
    </div>
@elseif ($svg === 'cmt')
    <button type="button" class="py-2 px-3 inline-flex text-sm text-gray-700 dark:text-gray-300 items-center rounded-md bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700" data-dropdown-toggle="{{ $id }}">
        <svg class="w-4 h-4 text-red-500 dark:text-red-500" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
            <g transform="translate(0,24) scale(0.1,-0.1)" fill="currentColor" stroke="none">
                <path d="M110 220 c0 -11 5 -20 10 -20 6 0 10 9 10 20 0 11 -4 20 -10 20 -5 0 -10 -9 -10 -20z"></path>
                <path d="M50 212 c0 -12 19 -26 26 -19 2 2 -2 10 -11 17 -9 8 -15 8 -15 2z"></path>
                <path d="M170 205 c-8 -9 -8 -15 -2 -15 12 0 26 19 19 26 -2 2 -10 -2 -17 -11z"></path>
                <path d="M70 160 c-15 -15 -20 -33 -20 -70 l0 -50 70 0 70 0 0 50 c0 59 -24 90 -70 90 -17 0 -39 -9 -50 -20z"></path>
                <path d="M15 160 c3 -5 11 -10 16 -10 6 0 7 5 4 10 -3 6 -11 10 -16 10 -6 0 -7 -4 -4 -10z"></path>
                <path d="M205 160 c-3 -5 -2 -10 4 -10 5 0 13 5 16 10 3 6 2 10 -4 10 -5 0 -13 -4 -16 -10z"></path>
                <path d="M30 15 c0 -12 17 -15 90 -15 73 0 90 3 90 15 0 12 -17 15 -90 15 -73 0 -90 -3 -90 -15z"></path>
            </g>
        </svg>
    </button>
    <div id="{{ $id }}" class="z-10 hidden bg-white border border-gray-300 dark:border-gray-500 rounded shadow w-26 dark:bg-gray-700">
        <ul class="py-1 text-xs text-gray-700 dark:text-gray-200" aria-labelledby="ddReportMenuBtn-{{ $id }}">
            <li>
                <a click="#"
                   @click="$dispatch('open-confirm', {type: 'single-comment-report', link: '', message: '음란물, 게시물 신고, 불법촬영물, 홍보, 혐오,<br>허위 신고나 신고 사유와 맞지 않는 신고는<br>답변되지 않을 수 있으며 차단될 수 있습니다.<br>해당 댓글에 대한 신고를 진행하시겠습니까?'}); $wire.set('reportCommentId', {{ $idx }})" wire:click.prevent="$set('commentReport', '음란물')"
                   class="block px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">음란물</a>
            </li>
            <li>
                <a click="#"
                   @click="$dispatch('open-confirm', {type: 'single-comment-report', link: '', message: '음란물, 게시물 신고, 불법촬영물, 홍보, 혐오,<br>허위 신고나 신고 사유와 맞지 않는 신고는<br>답변되지 않을 수 있으며 차단될 수 있습니다.<br>해당 댓글에 대한 신고를 진행하시겠습니까?'}); $wire.set('reportCommentId', {{ $idx }})" wire:click.prevent="$set('commentReport', '게시물 신고')"
                   class="block px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">게시물 신고</a>
            </li>
            <li>
                <a click="#"
                   @click="$dispatch('open-confirm', {type: 'single-comment-report', link: '', message: '음란물, 게시물 신고, 불법촬영물, 홍보, 혐오,<br>허위 신고나 신고 사유와 맞지 않는 신고는<br>답변되지 않을 수 있으며 차단될 수 있습니다.<br>해당 댓글에 대한 신고를 진행하시겠습니까?'}); $wire.set('reportCommentId', {{ $idx }})" wire:click.prevent="$set('commentReport', '불법촬영물')"
                   class="block px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">불법촬영물</a>
            </li>
        </ul>
    </div>
@endif
