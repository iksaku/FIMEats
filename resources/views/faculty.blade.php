@extends('template.main')

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

    @foreach($faculty->cafeterias()->get() as $cafeteria)
        <section class="box special features">
            <h3>{{ $cafeteria->name() }}</h3>
            @foreach($cafeteria->menus()->get() as $menu)
                <h4>{{ $menu->name() }}</h4>

                @php($consumables = $menu->consumables()->get())
                @for($i = 0; $i < count($consumables) - 1; $i += 2)
                    <div class="features-row">
                        @for($j = 0; $j < 2; ++$j)
                            @php($consumable = $consumables[$i + $j])
                            <section>
                                <span class="img major" style="height: 225px; display: block">
                                    <img src="{{ $consumable->image() }}" style="max-height: 225px;">
                                </span>
                                <h3>{{ $consumable->name() }} {{ $consumable->price() }}</h3>
                                <ul class="actions special">
                                    @foreach($consumable->categories()->get() as $category)
                                        <li><a class="button alt small">{{ $category->name() }}</a></li>
                                    @endforeach
                                </ul>
                                <ul class="actions special">
                                    <li>
                                        <a class="button alt icon fa-balance-scale">Comparar con otras facultades</a>
                                    </li>
                                </ul>
                            </section>
                        @endfor
                    </div>
                @endfor
            @endforeach
        </section>
    @endforeach
@endsection