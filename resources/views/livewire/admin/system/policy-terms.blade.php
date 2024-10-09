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
                                <a href="#" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">시스템 설정</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">이용약관 / 개인정보처리방침</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-lg font-semibold text-gray-900 dark:text-white">이용약관 / 개인정보처리방침</h1>
            </div>

            <div x-data="{ policyTermsTab: 'terms' }" class="p-3 my-7 bg-white border border-gray-200 rounded-md shadow-sm col-span-full dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px">
                        <li class="me-2">
                            <button
                                @click.prevent="policyTermsTab = 'terms'"
                                :class="{
                                    'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500': policyTermsTab === 'terms',
                                    'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': policyTermsTab !== 'terms'
                                }"
                                class="inline-block p-4 border-b-2 rounded-t-lg"
                            >이용약관</button>
                        </li>
                        <li class="me-2">
                            <button
                                @click.prevent="policyTermsTab = 'policy'"
                                :class="{
                                    'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500': policyTermsTab === 'policy',
                                    'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300': policyTermsTab !== 'policy'
                                }"
                                class="inline-block p-4 border-b-2 rounded-t-lg"
                            >개인정보처리방침</button>
                        </li>
                    </ul>
                </div>
                <div wire:ignore>
                    <div x-show="policyTermsTab === 'terms'" class="py-4 rounded-md bg-gray-50 dark:bg-gray-800">
                        <label for="terms" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                        <textarea id="terms" wire:model.debounce="terms" class="editor p-[7px] w-full text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="이용약관을 입력해주세요.">{{ $terms }}</textarea>
                    </div>
                    <div x-show="policyTermsTab === 'policy'" class="py-4 rounded-md bg-gray-50 dark:bg-gray-800">
                        <label for="policy" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"></label>
                        <textarea id="policy" wire:model="policy" class="editor block p-[7px] w-full text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="개인정보처리방침을 입력해주세요.">{{ $policy }}</textarea>
                    </div>
                </div>
                <div class="col-span-6 sm:col-full text-right pt-8">
                    <button type="button" id="btnSave" wire:click.prevent="updatePolicyTerms" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-md text-sm px-5 py-[7px] text-center dark:bg-blue-600 dark:hover:bg-blue-700">저장</button>
                </div>
            </div>
        </div>
    </div>


</main>
@push('scripts')
    <x-ckeditor id="terms" btn="#btnSave" />
    <x-ckeditor id="policy" btn="#btnSave" />
@endpush
