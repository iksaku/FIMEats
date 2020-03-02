<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ app_title() }}</title>

        {{-- Styles --}}
        <link rel="icon" href="{{ asset('favicon.png') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="min-h-screen h-full w-full flex flex-col bg-gray-200 scrolling-touch">
        @yield('body')

        {{-- Scripts --}}
        <script src="{{ mix('js/fontawesome.js') }}" defer></script>
    </body>
</html>
