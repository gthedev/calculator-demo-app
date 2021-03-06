<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Calculator</title>

    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css') }}?t={{ time() }}"/>
    @stack('styles')
</head>
<body>
@yield('content')

@stack('scripts')
</body>
</html>
