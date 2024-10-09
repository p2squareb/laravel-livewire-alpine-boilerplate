<main>
    <div class="p-3 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-3">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <a href="#" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">포인트 관리</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">포인트 설정</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 sm:text-lg dark:text-white">포인트 설정</h1>
            </div>

            <div class="p-3 sm:p-6 my-3 bg-white border border-gray-200 rounded-md shadow-sm col-span-full dark:border-gray-700 dark:bg-gray-800">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_point_join" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">회원가입시</label>
                        <input wire:model="use_point_join" id="use_point_join-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_join-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_join" id="use_point_join-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_join-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_join_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_join_amt" id="use_point_join_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="use_point_login" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">로그인시 (1일 1회 기준)</label>
                        <input wire:model="use_point_login" id="use_point_login-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_login-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_login" id="use_point_login-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_login-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_login_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_login_amt" id="use_point_login_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_point_write" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">글 작성시</label>
                        <input wire:model="use_point_write" id="use_point_write-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_write-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_write" id="use_point_write-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_write-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_write_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_write_amt" id="use_point_write_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="use_point_write_comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">본인의 작성글에 타 유저가 댓글 작성시</label>
                        <input wire:model="use_point_write_comment" id="use_point_write_comment-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_write_comment-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_write_comment" id="use_point_write_comment-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_write_comment-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_write_comment_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_write_comment_amt" id="use_point_write_comment_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_point_write_up" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">본인의 작성글에 타 유저가 추천시</label>
                        <input wire:model="use_point_write_up" id="use_point_write_up-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_write_up-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_write_up" id="use_point_write_up-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_write_up-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_write_up_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_write_up_amt" id="use_point_write_up_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-4">
                        <label for="use_point_write_down" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">본인의 작성글에 타 유저가 비추천시</label>
                        <input wire:model="use_point_write_down" id="use_point_write_down-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_write_down-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_write_down" id="use_point_write_down-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_write_down-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_write_down_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_write_down_amt" id="use_point_write_down_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_point_comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">댓글 작성시</label>
                        <input wire:model="use_point_comment" id="use_point_comment-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_comment-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_comment" id="use_point_comment-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_comment-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_comment_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_comment_amt" id="use_point_comment_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_point_comment_up" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">본인의 댓글에 타 유저가 추천시</label>
                        <input wire:model="use_point_comment_up" id="use_point_comment_up-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_comment_up-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_comment_up" id="use_point_comment_up-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_comment_up-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_comment_up_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_comment_up_amt" id="use_point_comment_up_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_point_comment_down" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">본인의 댓글에 타 유저가 비추천시</label>
                        <input wire:model="use_point_comment_down" id="use_point_comment_down-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_point_comment_down-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_point_comment_down" id="use_point_comment_down-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="use_point_comment_down-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="use_point_comment_down_amt" class="text-sm font-medium text-gray-900 dark:text-white mr-1">지급 포인트</label>
                        <input type="number" wire:model="use_point_comment_down_amt" id="use_point_comment_down_amt" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[50px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">pt</div>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-full text-right pt-2">
                <button type="button" wire:click.prevent="updatePoint" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">저장</button>
            </div>
        </div>
    </div>
</main>
