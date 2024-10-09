<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) }"
      :class="{ 'dark': darkMode }"
      x-init="$watch('darkMode', value => { localStorage.setItem('color-theme', value ? 'dark' : 'light') })"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CKEditor -->
    <script src="/assets/vendor/ckeditor5/build/ckeditor.js"></script>
    <script src="/assets/vendor/ckeditor5/build/script.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900">

<livewire:layouts.partials.app-navbar />

<div class="flex-grow">
    <div class="flex pt-14 overflow-hidden bg-gray-100 dark:bg-gray-900">
        <div id="main-content" class="relative w-full max-w-screen-xl mx-auto h-full overflow-y-auto bg-gray-100 dark:bg-gray-900">
            {{ $slot }}
            {{--@include('layouts.partials.app-footer')--}}
        </div>
    </div>
</div>

@include('layouts.partials.app-footer')

@livewireScripts
@stack('scripts')
</body>
</html>
