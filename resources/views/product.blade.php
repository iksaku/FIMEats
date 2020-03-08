<?php /** @var \App\Product[] $products */ ?>

@extends('partials.app')

@section('title', 'Compara Precios')

@section('contents')
    @component('components.card')
        <div class="overflow-hidden overflow-x-auto border border-gray-300 rounded">
            <table class="table w-full" cellspacing="0" cellpadding="0">
                <thead
                    class="bg-green-700 text-white border-b border-gray-300"
                >
                <tr>
                    <td class="w-1/3 text-center p-2">Nombre</td>
                    <td class="w-1/6 text-center p-2">Cantidad</td>
                    <td class="w-1/3 text-center p-2">Cafetería</td>
                    <td class="w-1/6 text-center p-2">Precio</td>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr
                        class="bg-green-100 hover:bg-green-200 border-b border-gray-300 @if(isset($ref)) first:border-dashed first:border-b-4 @endif"
                    >
                        <td class="whitespace-no-wrap p-2">
                            {{ $product->name }}
                        </td>
                        <td class="whitespace-no-wrap text-center p-2">
                            {{ $product->quantity || "-" }}
                        </td>
                        <td class="whitespace-no-wrap p-2">
                            <a
                                href="{{ route('faculty.show', [$product->cafeteria->faculty, '#' . $product->cafeteria->slug]) }}"
                                class="underline hocus:no-underline"
                            >
                                {{ $product->cafeteria->name }}
                            </a>
                        </td>
                        <td class="whitespace-no-wrap p-2">
                            ${{ $product->price }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endcomponent
@endsection
