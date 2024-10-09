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
                                <a href="#" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">시스템 설정</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">기본 환경설정</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 sm:text-lg dark:text-white">기본 환경설정</h1>
            </div>

            <div class="p-3 sm:p-6 my-3 bg-white border border-gray-200 rounded-md shadow-sm col-span-full dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center mb-5">
                    <div class="flex flex-col">
                        <h3 class="text-base font-semibold dark:text-white">기본 정보</h3>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-2">
                        <label for="site_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">사이트명</label>
                        <input type="text" wire:model="site_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="사이트명을 입력해주세요.">
                        @error('site_name')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="domain_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">도메인</label>
                        <input type="text" wire:model="domain_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required placeholder="도메인을 입력해주세요.">
                        @error('domain_name')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="sq_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">대표 이메일</label>
                        <input type="email" wire:model="sq_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" required placeholder="대표 이메일을 입력해주세요.">
                        @error('sq_email')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_smtp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            SMTP 사용
                            <span class="text-xs text-yellow-700 dark:text-yellow-500 ml-2">(선행조건 : .env 설정 필요)</span>
                        </label>
                        <input wire:model="use_smtp" id="use_smtp-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_smtp-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_smtp" id="use_smtp-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                        <label for="use_smtp-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-4">사용안함</label>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_external_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            외부 이메일 서비스 사용
                            <span class="text-xs text-yellow-700 dark:text-yellow-500 ml-2">(시스템설정 > 외부서비스 설정)</span>
                        </label>
                        <input wire:model="use_external_email" id="use_external_email-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_external_email-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_external_email" id="use_external_email-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                        <label for="use_external_email-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-4">사용안함</label>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="use_dormant" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            휴면회원 사용여부 설정
                            <button data-popover-target="popover-description-dormant" data-popover-placement="bottom-end" type="button" class="align-top mt-[2px]"><svg class="w-4 h-4 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg><span class="sr-only">Show information</span></button>
                        </label>
                        <input wire:model="use_dormant" id="use_dormant-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="use_dormant-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="use_dormant" id="use_dormant-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-4">
                        <label for="use_dormant-0" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-4">사용안함</label>
                        <div data-popover="" id="popover-description-dormant" role="tooltip" class="absolute z-10 inline-block text-xs font-light text-gray-700 transition-opacity duration-300 bg-white border border-gray-200 rounded-md shadow-sm w-80 sm:w-[520px] dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 opacity-0 invisible" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-263px, 81px, 0px);" data-popper-placement="bottom-end">
                            <div class="p-3 space-y-2">
                                <h3 class="font-semibold text-gray-900 dark:text-white">개인정보 유효기간제</h3>
                                <p>• 2023년9월15일 개인정보보호법 개정에 따라 '개인정보 유효기간제'가 폐지되었습니다.</p>
                                <p>• 업체 운영방침에 따라 자율적으로 휴면회원 배치 사용여부를 설정할 수 있습니다.</p>
                                <p>• 1년 이상 미접속자는 휴면회원으로 전화되며, 휴면회원은 SMS/알림톡/이메일 알림을 받지 않습니다.</p>
                                <p>• 기능을 사용하시려면 서버에 스케줄러를 등록해주세요.</p>
                            </div>
                            <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate3d(271px, 0px, 0px);"></div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="p-3 sm:p-6 my-3 bg-white border border-gray-200 rounded-md shadow-sm col-span-full dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center mb-5">
                    <div class="flex flex-col">
                        <h3 class="text-base font-semibold dark:text-white">이미지 파일</h3>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="image_resize_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white items-center">
                            이미지 resize
                            <span class="text-xs text-yellow-700 dark:text-yellow-500 ml-2">
                                <a href="https://www.php.net/imagick" target="_blank" class="hover:underline">(선행조건 : ImageMagick 모듈 설치)</a>
                            </span>
                        </label>
                        <input wire:model="image_resize" id="image_resize-1" type="radio" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                        <label for="image_resize-1" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1">사용함</label>
                        <input wire:model="image_resize" id="image_resize-0" type="radio" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 dark:bg-gray-700 dark:border-gray-600 ml-3">
                        <label for="image_resize-0" class="ms-1 text-sm font-medium text-gray-900 dark:text-gray-300 ml-1 mr-3">사용안함</label>
                        <label for="image_width_max" class="text-sm font-medium text-gray-900 dark:text-white mr-1">가로 최대</label>
                        <input type="number" wire:model="image_width_max" id="image_width_max" class="rounded-s-md bg-gray-50 border text-gray-900 focus:border-blue-500 w-[56px] sm:w-[80px] text-sm border-gray-300 p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="1280">
                        <div class="inline-flex rounded-e-md bg-gray-200 border text-gray-900 focus:border-blue-500 w-[34px] text-sm border-gray-300 p-[7px] -ml-1 dark:bg-gray-600 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">px</div>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-full text-right pt-2">
                <button type="button" wire:click.prevent="updateBasic" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">저장</button>
            </div>
        </div>
    </div>
</main>
