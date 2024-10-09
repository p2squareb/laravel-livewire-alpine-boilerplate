@props(['modalId', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div
    x-data="{show : false, modalId : '{{ $modalId }}'}"
    x-show="show"
    x-on:open-modal.window="show = (modalId === $event.detail.modalId)"
    x-on:close-modal.window="show = false"
    style="display: none;"
    class="jetstream-modal fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900 dark:bg-opacity-85"></div>
    </div>

    <div x-show="show" class="fixed inset-0 flex items-center justify-center transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto m-3"
         x-trap.inert.noscroll="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        {{ $slot }}

    </div>
</div>





