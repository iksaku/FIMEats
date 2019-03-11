<head>
    <title>
        {{ config('app.name') }}
        @if(isset($title) && !empty($title))
            | {{ $title }}
        @endif
    </title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    @stack('stylesheets')
</head>