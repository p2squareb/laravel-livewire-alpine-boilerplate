@extends('errors.layout')
@section('content')
    <button id="auto-click-button" @click="$dispatch('open-alert', {type: '{{ $type }}', next: '{{ $next }}', link: '{{ $link }}', message: '{{ $message }}'})"></button>
    @once <x-alert /> @endonce
    <script>
        document.addEventListener('livewire:navigated', () => {
            function waitForElement(selector, callback) {
                const element = document.querySelector(selector);
                if (element) {
                    callback(element);
                } else {
                    setTimeout(() => waitForElement(selector, callback), 100);
                }
            }

            waitForElement('#auto-click-button', (button) => {
                button.click();
            });
        })
    </script>
@endsection
