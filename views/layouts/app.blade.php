<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ env('APP_URL') }}">

    <title>{{ config('appframe.title', config('app.name')) }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">--}}

    <!-- Styles -->
    <link href="{{ asset('lmi/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('lmi/css/page.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('lmi/css/materialize.min.css') }}" rel="stylesheet">--}}

</head>
<body>
<div id="app">
    <div class="wrapper row1">
        <header id="header" class="clear">
            <l-m-i-h-group title="{{ config('appframe.title', config('app.name')) }}" description="{{ config('appframe.page_description') }}"></l-m-i-h-group>
            <l-m-i-menu></l-m-i-menu>
        </header>
    </div>
    <div class="wrapper row2">
        <div id="container" class="clear">
            <section id="services" class="clear">
                @yield('content')
            </section>
        </div>
    </div>
    <div class="wrapper row3">
        <l-m-i-footer year="{{ date('Y') }}" title="{{ config('appframe.title') }}"></l-m-i-footer>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('lmi/js/page.js') }}" async></script>
{{--<script src="{{ asset('lmi/js/materialize.min.js') }}" async></script>--}}
<script src="{{ asset('lmi/js/app.js?_=' . rand()) }}" defer></script>
</body>
</html>
