@extends('template.main')

@section('content')
    <header>
        <h2><strong>{{ env('APP_NAME') }}</strong></h2>
        <p>Encuentras la comida que buscas, en el lugar que la buscas.</p>
    </header>

    <section id="facultades" class="box special features">
        <header>
            <h3>Porfavor elige tu facultad:</h3>
        </header>

        @for($i = 0; $i < count($faculties); $i += 2)
            <div class="features-row">
                @for($j = 0; $j < 2; ++$j)
                    @php($faculty = $faculties[$i + $j])
                    <section>
                        <span class="image major">
                            <img src="{{ asset('img/' . strtolower($faculty->short_name) . '.png') }}" style="max-height: 225px; max-width: 225px;">
                        </span>
                        <h3>{{ $faculty->short_name }}</h3>
                        <a class="button alt icon fa-search" href="{{ route('faculty', ['name' => $faculty->short_name]) }}">
                            Ver Menú
                        </a>
                    </section>
                @endfor
            </div>
        @endfor
    </section>
@endsection