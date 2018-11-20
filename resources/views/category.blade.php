@extends('template.main', [
    'title' => 'Buscando la categoria de "' . $category->name() . '""'
])

@section('content')
    <header>
        <h2>Explora la variedad de {{ $category->name() }} de las diferentes facultades</h2>
    </header>

    @php($cafeterias = $category->consumables->groupBy('cafeteria_id'))
    @foreach($cafeterias as $id => $consumables)
        <section class="box special features">
            <h3>{{ \App\Models\Cafeteria::whereId($id)->first()->name }}</h3>
            @for($i = 0; $i < $consumables->count() - 1; $i += 2)
                <div class="features-row">
                    @for($j = 0; $j < 2; ++$j)
                        @php($consumable = $consumables[$i + $j])
                        <section>
                        <span class="major">
                            <img src="{{ $consumable->image() }}">
                        </span>
                            <h3>{{ $consumable->name() }} {{ $consumable->price() }}</h3>
                            @php($cafeteria = $consumable->cafeteria)
                            <h4><a href="{{ $cafeteria->faculty->url() }}">{{ $cafeteria->name }}</a></h4>
                            <ul class="actions special">
                                @foreach($consumable->categories as $category)
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