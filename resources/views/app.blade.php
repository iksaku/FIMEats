<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="icon" href="{{ asset('img/favicon.png') }}">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        @inertia

        {{-- Scripts --}}
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</html>
