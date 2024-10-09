<div
    x-data="{ show : false, confirmType : '', confirmLink : '', confirmMsg : ''}"
    x-show="show"
    x-on:open-confirm.window="show = true; confirmType = $event.detail.type; confirmLink = $event.detail.link; confirmMsg = $event.detail.message;"
    x-on:close-confirm.window="show = false"
    style="display: none;"
    class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900 dark:bg-opacity-85"></div>
    </div>

    <div x-show="show" class="fixed inset-0 flex items-center justify-center transform transition-all"
         x-trap.inert.noscroll="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="relative w-full max-w-sm px-4">
            <div class="relative bg-white rounded-md shadow dark:bg-gray-800">
                <div class="p-6 text-center">
                    <svg class="w-12 h-12 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mt-5 mb-6 text-sm text-gray-500 dark:text-gray-400 leading-7" x-html="confirmMsg"></h3>
                    <button type="button" @click="$dispatch('close-confirm')" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-md text-sm px-5 py-[7px] dark:bg-gray-900 dark:text-white dark:border-gray-500 dark:hover:bg-gray-700 mr-2">취소하기</button>

                    {{-- 게시물 이동 (미개발) --}}
                    <button type="button" x-show="confirmType === 'group-move-update'"  wire:click.prevent="$dispatch('deleteSelectedRows')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-md text-sm inline-flex items-center px-5 py-[7px] text-center mr-2">이동하기</button>

                    {{-- 선택삭제 --}}
                    <button type="button" x-show="confirmType === 'multiple-delete'"  wire:click.prevent="$dispatch('deleteSelectedRows')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-md text-sm inline-flex items-center px-5 py-[7px] text-center mr-2">삭제하기</button>

                    {{-- 삭제 (삭제여부 상태변경) --}}
                    <button type="button" x-show="confirmType === 'single-delete'" wire:click.prevent="$dispatch('deleteRow')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-md text-sm inline-flex items-center px-5 py-[7px] text-center mr-2">삭제하기</button>

                    {{-- 댓글 삭제 (삭제여부 상태변경) --}}
                    <button type="button" x-show="confirmType === 'single-delete-comment'" wire:click.prevent="$dispatch('close-confirm');$dispatch('deleteComment')" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">삭제하기</button>

                    {{-- 삭제 링크 (링크 이동하여 삭제여부 상태변경) --}}
                    <button type="button" x-show="confirmType === 'single-delete-link'" @click="Livewire.navigate(confirmLink)" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">삭제하기</button>

                    {{-- 삭제 (데이터 삭제) --}}
                    <button type="button" x-show="confirmType === 'single-remove'" wire:click.prevent="$dispatch('removeRow')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-md text-sm inline-flex items-center px-5 py-[7px] text-center mr-2">삭제하기</button>

                    {{-- 게시물 신고 --}}
                    <button type="button" x-show="confirmType === 'single-write-report'" wire:click.prevent="$dispatch('close-confirm');$dispatch('updateWriteReport');" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">신고하기</button>

                    {{-- 댓글 신고 --}}
                    <button type="button" x-show="confirmType === 'single-comment-report'" wire:click.prevent="$dispatch('close-confirm');$dispatch('updateCommentReport');" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-red-600 dark:hover:bg-red-700">신고하기</button>

                    {{-- 선택 탈퇴철회 --}}
                    <button type="button" x-show="confirmType === 'multiple-restore-user'"  wire:click.prevent="$dispatch('restoreSelectedRows')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-md text-sm inline-flex items-center px-5 py-[7px] text-center mr-2">철회하기</button>

                    {{-- 반려 --}}
                    <button type="button" x-show="confirmType === 'single-return-back'"  wire:click.prevent="$dispatch('returnBackRow')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-md text-sm inline-flex items-center px-5 py-[7px] text-center mr-2">반려하기</button>
                </div>
            </div>
        </div>

    </div>
</div>





