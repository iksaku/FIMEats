<!DOCTYPE HTML>
<html>
    @include('template.components.head')

    <body class="is-preload">
        <div id="page-wrapper">
            @include('template.components.header')

            <section id="main" class="container">
                @yield('content')
            </section>

            @include('template.components.footer')
        </div>

        @include('template.components.scripts')
    </body>
</html>