@extends('template.main', [
    'title' => 'Buscando la categoria de "' . $category->name() . '""'
])

@section('content')
    <header>
        <h2>Explora la variedad de {{ $category->name() }} de las diferentes facultades</h2>
    </header>

    @php($cafeterias = $category->products->groupBy('cafeteria_id'))
    @foreach($cafeterias as $id => $products)
        <section class="box special features">
            <h3>{{ \App\Models\Cafeteria::whereId($id)->first()->name }}</h3>
            @for($i = 0; $i < $products->count() - 1; $i += 2)
                <div class="features-row">
                    @for($j = 0; $j < 2; ++$j)
                        @php($product = $products[$i + $j])
                        <section>
                        <span class="major">
                            <img src="{{ $product->image() }}">
                        </span>
                            <h3>{{ $product->name() }} {{ $product->price() }}</h3>
                            @php($cafeteria = $product->cafeteria)
                            <h4><a href="{{ $cafeteria->faculty->url() }}">{{ $cafeteria->name }}</a></h4>
                            <ul class="actions special">
                                @foreach($product->categories as $category)
                                    <li><a href="{{ $category->url() }}" class="button alt small">
                                            {{ $category->name() }}
                                        </a></li>
                                @endforeach
                            </ul>
                        </section>
                    @endfor
                </div>
            @endfor
        </section>
    @endforeach
@endsection