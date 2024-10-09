<div x-data="{
        toasts: [],
        addToast(type, message) {
            if (this.toasts.length > 0) { return false; }
            this.toasts.push({
                id: 'toast-' + Math.random().toString(16).slice(2),
                type: type,
                message: message,
                show: true,
            });

            let toast_pop_time = 0;
            if (type === 'Failure') {
                toast_pop_time = 5000;
            } else {
                toast_pop_time = 3000;
            }

            setTimeout(() => {
                this.destroyToast(this.toasts.length - 1);
            }, toast_pop_time);
        },
        destroyToast(index) {
            this.toasts[index].show = false;
            setTimeout(() => {
                this.toasts.splice(index, 1);
            }, 1000);
        }
    }"

     @toast-pop.window="addToast($event.detail[0].type, $event.detail[0].message)"
     class="fixed top-0 right-0 p-3" style="z-index:100;"
>
    <template x-for="(toast, index) in toasts" :key="toast.id">
        <div x-show="toast.show" @click="destroyToast(index)"
             x-transition:enter="transition ease-in duration-200"
             x-transition:enter-start="transform opacity-0 translate-y-2"
             x-transition:enter-end="transform opacity-100"
             x-transition:leave="transition ease-out duration-500"
             x-transition:leave-start="transform translate-x-0 opacity-100"
             x-transition:leave-end="transform translate-x-full opacity-0"
             class="shadow-lg mx-auto max-w-full text-md pointer-events-auto bg-clip-padding rounded-md block "
        >
            <div class="flex items-center w-full p-4 mb-4 text-gray-500 bg-white rounded-md shadow dark:text-gray-400 dark:bg-gray-800" style="border:3px solid #111827;">
                <div class="flex">
                    <div x-show="toast.type==='Success'" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-md dark:bg-green-800 dark:text-green-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                        </svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    <div x-show="toast.type==='Failure'" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-md dark:bg-red-800 dark:text-red-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                        </svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    <div x-show="toast.type==='WarningInfo'" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-md dark:bg-orange-700 dark:text-orange-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z"/>
                        </svg>
                        <span class="sr-only">Warning icon</span>
                    </div>
                    <div class="ml-3">
                        <span :class="{
                            'text-green-400 dark:text-green-400' : toast.type==='Success',
                            'text-red-500 dark:text-red-500' : toast.type==='Failure',
                            'text-orange-800 dark:text-orange-300' : toast.type==='WarningInfo'
                        }"
                              class="mb-1 text-xm font-semibold text-gray-900 dark:text-white" x-text="toast.type"></span>
                        <div class="mb-2 text-sm font-normal text-gray-900 dark:text-white" x-text="toast.message"></div>
                    </div>
                    <button type="button" class="ml-3 -mx-1.5 -my-1.5 bg-white items-center justify-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-md p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>







