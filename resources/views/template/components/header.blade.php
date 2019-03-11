<header id="header">
    <h1><a href="{{ route('index') }}">{{ config('app.name') }}</a></h1>
    <nav id="nav">
        <ul>
            <li><a href="{{ route('index') }}">Inicio</a></li>
            <li><a href="{{ route('index') . '#facultades' }}">Selecciona tu Facultad</a></li>
        </ul>
    </nav>
</header>