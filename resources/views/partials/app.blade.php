@extends('partials.template')

@section('body')
    @include('partials.navbar')

    <div class="flex-grow">
        <div class="w-full py-8">
            <div class="max-w-xl mx-auto text-center">
                <h1 class="text-gray-700 text-4xl">
                    @yield('title', config('app.name'))
                </h1>

                <hr class="w-full my-4 border-t-2" />

                <p class="text-gray-700 text-xl">
                    @yield('description')
                </p>
            </div>
        </div>

        <div class="container md:max-w-6xl mx-auto p-4">
            @yield('contents')
        </div>
    </div>
@endsection
