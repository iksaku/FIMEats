@extends('template.main')

@section('content')
    <header>
        <h2>{{ $faculty->short_name }}</h2>
        <p>{{ $faculty->name }}</p>
    </header>

    <section class="box">
        @foreach($faculty->cafeterias() as $cafeteria)
            <h3>{{ $cafeteria->name }}</h3>
            @foreach($cafeteria->menus() as $menu)
                <h5>{{ $menu->name }}</h5>
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Articulo</th>
                            <th>Precio</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($menu->consumables() as $consumble)
                                <tr>
                                    <td>
                                        @php
                                            echo join(', ', array_map(function($category) {
                                                return $category['name'];
                                            }, $consumble->categories()->toArray()))
                                        @endphp
                                    </td>
                                    <td>{{ $consumble->name }}</td>
                                    <td>{{ $consumble->price() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        @endforeach
    </section>
@endsection