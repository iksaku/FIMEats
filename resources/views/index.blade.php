@extends('template.main')

@section('content')
    <header>
        <h2><strong>{{ config('app.name') }}</strong></h2>
        <p>Encuentras la comida que buscas, en el lugar que la buscas.</p>
    </header>

    <section id="facultades" class="box special features">
        <header>
            <h3>Porfavor elige tu facultad:</h3>
        </header>

        @for($i = 0; $i < count($faculties) - 1; $i += 2)
            <div class="features-row">
                @for($j = 0; $j < 2; ++$j)
                    @php($faculty = $faculties[$i + $j])
                    <section onclick="window.location.href = '{{ $faculty->url() }}';">
                        <span class="major">
                            <img src="{{ $faculty->logo() }}" style="max-height: 225px; max-width: 225px;">
                        </span>
                        <h3>{{ $faculty->short_name }}</h3>
                        <a class="button alt icon fa-search" href="{{ $faculty->url() }}">
                            Ver Menú
                        </a>
                    </section>
                @endfor
            </div>
        @endfor
    </section>
@endsection