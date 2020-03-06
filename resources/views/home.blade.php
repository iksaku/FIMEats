<?php /** @var \App\Faculty[] $faculties */ ?>

@extends('partials.app')

@section('description', 'La comida que buscas, en el lugar que buscas.')

@section('contents')
    @component('components.card')
        <div class="w-full text-center mb-6">
            <h2 id="facultades" class="text-gray-700 text-2xl">
                Selecciona tu Facultad
            </h2>
        </div>

        <div class="w-full mx-auto flex flex-wrap items-stretch justify-evenly">
            @foreach($faculties as $faculty)
                <div class="w-full sm:w-1/2 lg:w-1/4 px-4 py-2">
                    <a
                        href="{{ route('faculty.show', $faculty) }}"
                        class="w-full block text-center bg-gray-100 px-4 py-2 rounded-lg overflow-hidden hocus:shadow-outline focus:outline-none transform duration-200 hocus:scale-110 hocus:z-10"
                    >
                        <img
                            class="h-40 w-40 rounded-lg mx-auto"
                            src="{{ $faculty->logo }}"
                            alt="Logo of {{ $faculty->short_name }} Faculty"
                        />

                        <h3 class="text-center text-gray-700 text-xl uppercase mt-2">
                            {{ $faculty->short_name }}
                        </h3>
                    </a>
                </div>
            @endforeach
        </div>
    @endcomponent
@endsection
