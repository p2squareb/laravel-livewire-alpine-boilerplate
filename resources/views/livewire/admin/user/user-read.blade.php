<main>
    <div class="p-3 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
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
                                <a href="{{ route('admin.board.list') }}" wire:navigate class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">회원 관리</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">회원정보</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="sm:flex justify-between">
                    <h1 class="text-lg font-semibold text-gray-900 dark:text-white mb-3 sm:mb-0">회원정보</h1>
                    <div class="sm:flex items-center  sm:space-x-2">
                        <div class="flex items-center mb-3 md:mb-0">
                            <div class="relative w-full">
                                <input type="search" wire:model="searchString" wire:keydown.enter="search" class="block p-[7px] w-full md:w-[270px] text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="이메일 or 닉네임을 입력해주세요."/>
                                <button type="button" wire:click.prevent="search" class="absolute top-0 end-0 px-3 py-[7px] text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:outline-none dark:bg-blue-600 dark:hover:bg-blue-700">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center mb-3 md:mb-0">
                            <div class="relative w-full">
                                <select wire:model.live="searchUserId" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:border-blue-500 block w-full p-[7px] dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                    @if ($searchResult)
                                        <option value="" selected>회원 선택</option>
                                        @foreach($searchResult as $user)
                                            <option value="{{ $user->id }}">{{ $user->nickname }}</option>
                                        @endforeach
                                    @else
                                        <option value="" selected>검색어를 입력해주세요.</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center mb-3 md:mb-0">
                            <div class="relative w-full">
                                <button type="button" @click="Livewire.navigate('{{ route('admin.user.list', request()->query()) }}')" class="w-full text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">목록</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sm:flex p-3 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center space-x-4 mb-2 sm:mb-0">
                    @if ($profile_photo_path)
                        <img src="/storage/profiles/{{ $profile_photo_path }}" class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0">
                    @else
                        <label for="profile" class="flex flex-col items-center justify-center w-28 h-28 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-20 h-20 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                </svg>
                            </div>
                        </label>
                    @endif
                    <div>
                        <h3 class="mb-1 text-xm font-bold text-gray-900 dark:text-white">프로필 이미지</h3>
                        <div class="mb-1 text-sm text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF</div>
                        <div class="mb-1 text-sm text-gray-500 dark:text-gray-400">Max. 128x128px</div>
                        <div class="flex items-center space-x-4">
                            @if ($profile_photo_path)
                                <button wire:click="deleteProfileImage" type="button" class="inline-flex items-center text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">
                                    <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                    이미지 삭제
                                </button>
                            @else
                                <button type="button" onclick="document.getElementById('profile').click()" class="inline-flex items-center px-3 py-[7px] text-sm font-medium text-center text-white rounded-md bg-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700">
                                    <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>
                                    이미지 업로드
                                </button>
                            @endif
                            <input wire:model="profile" id="profile" accept="image/*" type="file" class="hidden" />
                        </div>
                        @error('profile')<div class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</div>@enderror
                    </div>
                </div>
                <div class="items-center sm:ml-8">
                    <div class="flex flex-col text-sm text-gray-900 dark:text-white">
                        <div class="flex items-center">
                            이메일 : {{ $userData['userInfo']->email }}
                        </div>
                        <div class="flex items-center mt-1">
                            닉네임 : {{ $userData['userInfo']->nickname }}
                        </div>
                        <div class="flex items-center mt-1">
                            회원그룹 : {{ $userData['userInfo']->group->name }}
                        </div>
                        <div class="flex items-center mt-1">
                            가입유형 : {{ strtoupper($userData['userInfo']->social_type) }}
                        </div>
                        <div class="flex items-center mt-1">
                            포인트 : {{ number_format($userData['userInfo']->point) }} pt
                        </div>
                    </div>
                </div>
                <div class="items-start sm:ml-8">
                    <div class="flex flex-col text-sm text-gray-900 dark:text-white">
                        <div class="flex items-center mt-1">
                            가입일 : {{ humanReadableDate($userData['userInfo']->created_at, 3) }}
                        </div>
                        <div class="flex items-center mt-1">
                            최근 로그인 : {{ humanReadableDate($userData['userInfo']->last_login_at, 3) }} / {{ $userData['userInfo']->login_ip }}
                        </div>
                        <div class="flex items-center mt-1">
                            상태 :
                            @if ($userData['userInfo']->status === 1)
                                <div class="h-2.5 w-2.5 rounded-full bg-green-400 mr-2 ml-1"></div>가입
                            @elseif ($userData['userInfo']->status === 2)
                                <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2 ml-1"></div>탈퇴
                            @elseif ($userData['userInfo']->status === 3)
                                <div class="h-2.5 w-2.5 rounded-full bg-orange-400 mr-2 ml-1"></div>정지
                            @elseif ($userData['userInfo']->status === 4)
                                <div class="h-2.5 w-2.5 rounded-full bg-neutral-500 mr-2 ml-1"></div>휴면
                            @endif
                        </div>
                        <div class="flex items-center mt-1">
                            @if ($userData['userInfo']->status === 2)
                                탈퇴일자 : {{ humanReadableDate($userData['userInfo']->leaved_at, 3) }}
                            @elseif ($userData['userInfo']->status === 3)
                                정지일자 : {{ humanReadableDate($userData['userProhibit']->created_at, 3) }} / 해제 예정일 : {{ humanReadableDate($userData['userProhibit']->until_date, 3) }}
                            @elseif ($userData['userInfo']->status === 4)
                                휴면일자 : {{ humanReadableDate($userData['userDormant']->created_at, 3) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div x-data="{ userDataTab: 'point' }">
                <div class="text-base font-medium text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <a href="#"
                               @click.prevent="userDataTab = 'point'"
                               :class="{
                                'text-blue-600  border-blue-600 active dark:text-blue-500 dark:border-blue-500': userDataTab === 'point',
                                'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': userDataTab !== 'point'
                            }"
                               class="inline-block p-4 border-b-2 rounded-t-lg">포인트 내역 (최근 15건)</a>
                        </li>
                        <li class="me-2">
                            <a href="#"
                               @click.prevent="userDataTab = 'inquiry'"
                               :class="{
                                'text-blue-600  border-blue-600 active dark:text-blue-500 dark:border-blue-500': userDataTab === 'inquiry',
                                'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': userDataTab !== 'inquiry'
                            }"
                               class="inline-block p-4 border-b-2 rounded-t-lg">1:1 문의내역 (최근 15건)</a>
                        </li>
                    </ul>
                </div>
                <div x-show="userDataTab === 'point'" class="py-4 rounded-md bg-gray-50 dark:bg-gray-800">
                    <livewire:admin.user.user-point :userId="$userId" />
                </div>
                <div x-show="userDataTab === 'inquiry'" class="py-4 rounded-md bg-gray-50 dark:bg-gray-800">
                    <livewire:admin.user.user-inquiry :userId="$userId" />
                </div>
            </div>



        </div>
    </div>

    @once <x-alert /> @endonce
</main>
