<?php /** @var \App\Models\Faculty[] $faculties */ ?>

@extends('partials.app')

@section('description', 'La comida que buscas, en el lugar que buscas.')

@section('contents')
    @component('components.card')
        <div class="w-full text-center mb-6">
            <h2 id="facultades" class="text-gray-700 text-2xl">
                Selecciona tu Facultad
            </h2>
        </div>

        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            <!-- This example requires Tailwind CSS v2.0+ -->

        @foreach($faculties as $faculty)
                <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <a href=" {{ route('faculty.show', $faculty) }} ">
                        <div class="flex-1 flex flex-col p-8">
                            <img class="w-32 h-32 flex-shrink-0 mx-auto bg-black rounded-full" src="{{ $faculty->logo }}" alt="">
                            <h3 class="mt-6 text-gray-900 text-sm font-medium">{{ $faculty->name }}</h3>
                            <dl class="mt-1 flex-grow flex flex-col justify-between">
                                <dt class="sr-only">{{ $faculty->short_name }}</dt>
                                <dd class="mt-3">
                                    <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{ $faculty->short_name }}</span>
                                </dd>
                            </dl>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endcomponent
@endsection
