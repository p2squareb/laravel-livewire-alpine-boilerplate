<div class="grid grid-cols-1 px-4 2xl:px-0 my-3 gap-4">
    <div class="p-3 sm:p-5 mb-3 bg-white border border-gray-200 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 xl:mb-0">
        <div class="flex items-center justify-between mb-3">
            <h3 class="inline-flex text-lg font-semibold text-gray-900 dark:text-white items-center">
                댓글 @if ($commentData->total() > 0){{ number_format($commentData->total()) }}개@endif
            </h3>
        </div>
        <div class="overflow-y-auto lg:max-h-[60rem] 2xl:max-h-fit">
            @foreach($commentData as $comment)
                <article class="mb-5" wire:key="{{$comment->id}}" x-data="{ showReplyTextarea: @entangle('showReplyTextarea.'.$comment->id) }" style="padding-left:{{$comment->depth * 20}}px">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <p class="inline-flex items-center mr-3 text-sm font-semibold text-gray-900 dark:text-white">
                                @if ($comment->user->profile_photo_path)
                                    <img class="w-6 h-6 mr-2 rounded-full" src="/storage/profiles/{{ $comment->user->profile_photo_path }}" alt="{{ $comment->writer }}'s avatar">
                                @else
                                    <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                                    </svg>
                                @endif
                                {{ $comment->writer }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ humanReadableDate($comment->created_at, 2) }}</p>
                        </div>
                        <div class="{{ ($comment->is_delete === 1) ? 'hidden' : 'flex' }} items-center space-x-3">
                            @if (auth()->check() && (auth()->user()->group_level >= 11 || $comment->user_id === auth()->user()->id))
                                <button id="ddCmtMenuBtn{{ $comment->id }}" data-dropdown-toggle="ddCmtMenu{{ $comment->id }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 bg-white rounded-md hover:bg-gray-100 focus:outline-none dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-gray-300" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                    </svg>
                                </button>
                                <div id="ddCmtMenu{{ $comment->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-20 dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton">
                                        <li>
                                            <a @click="$dispatch('open-modal', {modalId: 'update-comment-modal'})" wire:click.prevent="updateModal({{ $comment->id }})" class="inline-flex items-center px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>수정</a>
                                        </li>
                                        <li>
                                            <a @click="$dispatch('open-confirm', {type: 'single-delete-comment', link: '', message: '정말로 댓글을 삭제하시겠습니까?'})" wire:click.prevent="$set('deleteCommentId', {{ $comment->id }})" class="inline-flex items-center px-4 py-2 hover:bg-blue-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>삭제</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($comment->is_delete === 1)
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">삭제된 댓글입니다.</p>
                    @else
                        <p class="mb-2 text-sm text-gray-900 dark:text-white">{!! nl2br($comment->comment) !!}</p>
                        <div x-show="showReplyTextarea" class="flex-row">
                            <div class="flex-row items-center">
                                <textarea id="replyComment" wire:model="replyComment" rows="5" class="block p-2 w-full text-sm text-gray-900 bg-white rounded-md border border-gray-300 focus:border-primary-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-primary-500" placeholder="답글을 입력해주세요."></textarea>
                            </div>
                            <div class="flex items-center justify-end my-2">
                                <button type="button" @click="showReplyTextarea = !showReplyTextarea" class="inline-flex p-2 rounded-md text-sm items-center text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600">
                                    <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    <span class="text-sm">취소</span>
                                </button>
                                <button type="button" wire:click.prevent="createReplyComment({{ $comment->id }})" class="inline-flex p-2 rounded-md text-sm items-center text-blue-600 hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                                    <svg aria-hidden="true" class="w-5 h-5 rotate-90 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                                    <span class="text-sm">답글</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mb-2 space-x-2">
                            @if ($board->use_rate === 1)
                                <button type="button" @if(auth()->check()) wire:click.prevent="updateCommentRate('up')" @click="$wire.set('rateCommentId',{{ $comment->id }});" @endif class="py-1.5 px-3 inline-flex text-sm text-gray-700 dark:text-gray-300 items-center rounded-md bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700">
                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd"/>
                                    </svg>{{ number_format($comment->rate_up, 0) }}
                                </button>
                                <button type="button" @if(auth()->check()) wire:click.prevent="updateCommentRate('down')" @click="$wire.set('rateCommentId',{{ $comment->id }});" @endif class="py-1.5 px-3 inline-flex text-sm text-gray-700 dark:text-gray-300 items-center rounded-md bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700">
                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z" clip-rule="evenodd"/>
                                    </svg>{{ number_format($comment->rate_down, 0) }}
                                </button>
                            @endif
                            @auth
                                <button type="button" @click="showReplyTextarea = !showReplyTextarea;" class="py-2 px-3 inline-flex text-sm text-gray-700 dark:text-gray-300 items-center rounded-md bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 dark:bg-gray-700">
                                    <svg class="w-[16px] h-[16px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                                @if ($board->use_report === 1)
                                    <div class="inline-flex">
                                        <x-report id="ddReportM" svg="cmt" :idx="$comment->id" />
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endif
                </article>
            @endforeach
            <div class="flex items-center justify-between">
                @if($commentData->hasMorePages())
                    <div class="flex w-full items-center justify-start mb-7">
                        <button type="button" wire:click.prevent="moreComment" wire:loading.attr="disabled" class="inline-flex text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 text-gray-800 dark:text-white -ml-1 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"/>
                            </svg>댓글 더보기
                        </button>
                        <span wire:loading>Loading...</span>
                    </div>
                @endif
                @auth()
                    <div class="flex w-full items-center justify-end mb-7">
                        <button type="button" @click="$dispatch('open-modal', {modalId : 'create-comment-modal'})" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                            <svg aria-hidden="true" class="w-5 h-5 rotate-90 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>등록
                        </button>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <x-modal modalId="create-comment-modal" maxWidth="xl">
        <div class=" w-full bg-white rounded-md shadow dark:bg-gray-800 lg:px-2">
            <div class="flex items-start justify-between p-3">
                <h3 class="text-lg font-semibold dark:text-white">댓글 쓰기</h3>
                <button type="button" @click="$dispatch('close-modal'); $wire.set('comment', '')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="grid grid-cols-6 gap-2">
                <div class="col-span-6 px-3">
                    <textarea id="comment" wire:model="comment" rows="7" class="text-sm p-2 w-full text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="댓글을 입력해주세요."></textarea>
                    @error('comment')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                </div>
                <div class="col-span-6 text-right px-3 mb-5 space-x-2">
                    <button type="button" @click="$dispatch('close-modal'); $wire.set('comment', '')" class="inline-flex text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>취소
                    </button>
                    <button type="button" wire:click.prevent="createComment" class="inline-flex text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                        <svg aria-hidden="true" class="w-5 h-5 rotate-90 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>등록
                    </button>
                </div>
            </div>
        </div>
    </x-modal>

    <x-modal modalId="update-comment-modal" maxWidth="xl">
        <div class=" w-full bg-white rounded-md shadow dark:bg-gray-800 lg:px-2">
            <div class="flex items-start justify-between p-3">
                <h3 class="text-lg font-semibold dark:text-white">댓글 수정</h3>
                <button type="button" @click="$dispatch('close-modal'); $wire.set('editComment', '')" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="grid grid-cols-6 gap-2">
                <div class="col-span-6 px-3">
                    <textarea id="editComment" wire:model="editComment" rows="7" class="text-sm p-2 w-full text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="댓글을 입력해주세요."></textarea>
                    @error('editComment')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{$message}}</p>@enderror
                </div>
                <div class="col-span-6 text-right px-3 mb-5 space-x-2">
                    <button type="button" @click="$dispatch('close-modal'); $wire.set('editComment', '')" class="inline-flex text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">
                        <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>취소
                    </button>
                    <button type="button" wire:click.prevent="updateComment" class="inline-flex text-white bg-teal-700 hover:bg-teal-800 font-medium rounded-md text-sm px-3 py-[7px] text-center dark:bg-teal-600 dark:hover:bg-teal-700">
                        <svg aria-hidden="true" class="w-5 h-5 rotate-90 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>수정
                    </button>
                </div>
            </div>
        </div>
    </x-modal>
</div>

