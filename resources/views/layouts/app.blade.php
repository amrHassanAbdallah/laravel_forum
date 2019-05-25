<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script>
        window.App ={!!  json_encode([
        'csrfToken' => csrf_token(),
        'user'=>Auth::user(),
        'signedIn'=>Auth::check()
        ]) !!};
    </script>
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
<div id="app">
    @include('layouts.nav')
    <main class="py-4">
        @include('layouts.notification')
        @yield('content')
        <flash message="{{session('flash')}}"></flash>
    </main>
</div>
</body>
</html>
