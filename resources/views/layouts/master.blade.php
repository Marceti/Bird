<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Mandali' rel='stylesheet'>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body class="bg-grey-lighter" style="font-family: 'Mandali'; font-size: 100%">
<div id="app">
    @include('layouts.partials._navbar')

    <main class="p-4 mx-auto bg-grey-lighter" >
        @yield('content')
    </main>
        @include('layouts.partials._errors')
</div>
</body>
</html>
