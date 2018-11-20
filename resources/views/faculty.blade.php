@extends('template.main', [
    'title' => $faculty->name()
])

@section('content')
    <header>
        <h2>{{ $faculty->short_name }}</h2>
        <p>{{ $faculty->name() }}</p>
    </header>

    @if(!empty($faculty->maps_url))
        <section class="box special">
            <iframe src="{{ $faculty->maps_url }}"
                    style="border: 0; width: 90vw; height: 67.5vw; max-width: 600px; max-height: 450px;"
                    allowfullscreen></iframe>
        </section>
    @endif

    @foreach($faculty->cafeterias as $cafeteria)
        <section class="box special features">
            <h3>{{ $cafeteria->name }}</h3>
            @php($consumables = $cafeteria->consumables)
            @for($i = 0; $i < count($consumables) - 1; $i += 2)
                <div class="features-row">
                    @for($j = 0; $j < 2; ++$j)
                        @php($consumable = $consumables[$i + $j])
                        <section>
                            <span class="major">
                                <img src="{{ $consumable->image() }}">
                            </span>
                            <h3>{{ $consumable->name() }} {{ $consumable->price() }}</h3>
                            <ul class="actions special">
                                @foreach($consumable->categories as $category)
                                    <li>
                                        <a href="{{ $category->url() }}"
                                           class="button alt small">
                                            {{ $category->name() }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="actions special">
                                <li>
                                    <a href="{{ route('compare') }}?name={{ urlencode($consumable->name()) }}"
                                       class="button alt icon fa-balance-scale">
                                        Comparar con otras facultades
                                    </a>
                                </li>
                            </ul>
                        </section>
                    @endfor
                </div>
            @endfor
        </section>
    @endforeach
@endsection