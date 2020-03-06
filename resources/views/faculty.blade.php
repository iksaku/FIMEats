<?php /** @var \App\Faculty $faculty */ ?>

@extends('partials.app')

@section('title', $faculty->short_name)

@section('description', $faculty->name)

@section('contents')
    @if(!empty($faculty->maps_url))
        @component('components.card')
            <div x-data="{ open: false }">
                <button
                    class="w-full flex items-center justify-between px-4 text-gray-700 text-xl hover:cursor-pointer focus:outline-none"
                    @click="open = !open"
                >
                    <span class="fas fa-chevron-down transform duration-200" :class="open ? '-rotate-180' : ''"></span>

                    <span>
                        ¿No sabes como llegar?
                    </span>

                    <span class="fas fa-chevron-down transform duration-200" :class="open ? 'rotate-180' : ''"></span>
                </button>

                <div
                    x-cloak
                    x-show="open"
                    class="w-full text-center flex flex-col items-center justify-center"
                >
                    <p class="text-gray-600 text-lg mt-4">
                        Aquí tienes un mapa con la ubicación del lugar.
                    </p>

                    <iframe
                        src="{{ $faculty->maps_url }}"
                        class="map border-0 mt-4"
                    ></iframe>
                </div>
            </div>
        @endcomponent
    @endif

    @foreach($faculty->cafeterias as $cafeteria)
        @component('components.card')
            <div class="w-full text-center mb-6">
                <h2 id="{{ $cafeteria->slug }}" class="text-gray-700 text-2xl">
                    {{ $cafeteria->name }}
                </h2>
            </div>

            <div class="w-full mx-auto flex flex-wrap items-stretch justify-evenly">
                @foreach($cafeteria->products as $product)
                    <div class="h-full w-full sm:w-1/2 lg:w-1/4 p-4">
                        <a
                            href="{{ route('product.show', $product) }}"
                            class="h-full w-full block text-center bg-gray-100 flex flex-col px-4 py-2 rounded-lg overflow-hidden hocus:shadow-outline focus:outline-none transform duration-200 hocus:scale-110 hocus:z-10"
                        >
                            <div class="h-32 w-full rounded-lg">
                                <img
                                    class="h-full rounded-lg mx-auto"
                                    src="{{ $product->image }}"
                                    alt="Imagen representativa de {{ $product->name }}"
                                />
                            </div>

                            <div class="flex-1">
                                <div class="text-center text-gray-700 my-2 text-lg">
                                    @if(!empty($product->quantity))
                                        <span class="inline-block align-middle pr-2 mr-1 border-r border-gray-500">
                                            {{ $product->quantity }}
                                        </span>
                                    @endif

                                    <span class="inline-block align-middle normal-case">
                                        ${{ $product->price }}
                                    </span>
                                </div>

                                <span class="text-center text-gray-700 text-lg uppercase">
                                    {{ $product->name }}
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endcomponent
    @endforeach
@endsection
