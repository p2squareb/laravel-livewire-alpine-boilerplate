<!doctype html>
<html lang="ko"
      x-data="{ darkMode: (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) }"
      :class="{ 'dark': darkMode }"
      x-init="$watch('darkMode', value => { localStorage.setItem('color-theme', value ? 'dark' : 'light') })"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

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
<body x-data="{leftSideMenu: false}" class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-800">

<livewire:layouts.partials.admin-navbar />

<div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

    @include('layouts.partials.admin-sidebar')

    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

        {{ $slot }}

        @include('layouts.partials.admin-footer')

    </div>
</div>

<x-toast />

@livewireScripts
@stack('scripts')
</body>
</html>
