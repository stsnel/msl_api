<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/treejs.css', 'resources/css/treejs-custom.css'])
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <title>{{ config('app.name') }} - @yield('title')</title>
</head>
<body class="flex flex-col min-h-screen">
    
    <x-notifications.modals/>

    {{-- @include('notifications.flash-messages') --}}

    <nav>
        @include('partials._navbar')
    </nav>

    {{-- no general class attached due to landing page --}}
    <main class="">

        {{-- @yield('content') --}}
        {{ $slot }}

    </main>
    

    @include('partials._footer')
    @stack('vite')
</body>

</html>