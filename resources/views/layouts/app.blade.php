<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.v4/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.inc.dark')
        
        <main class="py-4">


            @yield('content')
        </main>
    </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
