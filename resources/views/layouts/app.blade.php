<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>
    <meta name="keywords" content="{{ config('site.keyword') }}">
    <meta name="description" content="{{ config('site.description') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('statics/css/mdui.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('statics/css/common.css') }}"/>
    <script src="{{ asset('statics/js/mdui.min.js') }}"></script>

    @yield('styles')
</head>

<body>

    <div class="mdui-container main">
        @yield('content')
    </div>

</body>

@yield('scripts')

@include('layouts._footer')

</html>