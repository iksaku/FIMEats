@extends('template.main', [
    'title' => 'Comparar precios'
])

@push('stylesheets')
    <style>
        .highlight-first tr:first-child {
            background-color: #fffb9d;
        }
    </style>
@endpush

@section('content')
    @if ($consumables->count() < 2)
        <header>
            <h2>
                @if($consumables->count() < 1)
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
                        @foreach($consumables as $consumable)
                            <tr>
                                <td>{{ $consumable->name() }}</td>
                                <td>
                                    @php($cafeteria = $consumable->cafeteria)
                                    <a href="{{ $cafeteria->faculty->url() }}">
                                        {{ $cafeteria->name }}
                                    </a>
                                </td>
                                <td>{{ $consumable->price() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    @endif
@endsection