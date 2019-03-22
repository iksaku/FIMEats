@extends('template.main', [
    'title' => 'Comparar precios'
])

@push('stylesheets')
    <style>
        .highlight-first tr:first-child {
            background-color: #ffffb2;
        }
    </style>
@endpush

@section('content')
    @if ($products->count() < 2)
        <header>
            <h2>
                @if($products->count() < 1)
                    No se han encontrado comidas con el nombre "{{ $name }}"
                @else
                    No se han encontrado otras comidas similares.
                @endif
            </h2>
        </header>
    @else
        <header>
            <h2>
                Compara los precios de un producto en diferentes cafeterias
            </h2>
        </header>
        <section class="box">
            <div class="table-wrapper">
                <table class="alt">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cafetería</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody class="highlight-first">
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name() }}</td>
                                <td>
                                    @php($cafeteria = $product->cafeteria)
                                    <a href="{{ $cafeteria->faculty->url() }}">
                                        {{ $cafeteria->name }}
                                    </a>
                                </td>
                                <td>{{ $product->price() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
@endsection