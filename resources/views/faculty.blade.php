<?php /** @var \App\Models\Faculty $faculty */ ?>

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

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                @foreach($cafeteria->products as $product)
                    <div class="group col-span-1 p-4 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-xl border">
                        <a href="{{ route('product.compare', ['name' => $product, 'ref' => $product->id]) }}" class="h-full w-full flex flex-col justify-between">
                            <div class="w-full overflow-hidden rounded-lg relative flex-grow-1">
                                <img src="{{ $product->image }}"
                                     alt="Imagen representativa de {{ $product->name }}"
                                     class="h-32 mx-auto rounded-lg"/>
                            </div>
                            <div class="mt-4">
                                <div class="flex">
                                    <div class="overflow-hidden w-full flex-grow-1">
                                        <p title="{{ $product->name }}" class="font-semibold whitespace-nowrap overflow-ellipsis w-full overflow-hidden">{{ $product->name }}</p>
                                        <p class="text-gray-500 dark:text-gray-200">${{ number_format($product->price, 2) }}</p>
                                    </div>
                                    <div class="ml-4 pt-0.5 flex-shrink-0">
                                        <div class="w-auto h-auto px-1 py-0.5 rounded-lg bg-yellow-200 text-sm lig">
                                            {{ $product->categories[0]->name }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endcomponent
    @endforeach
@endsection
