<header id="header">
    <h1><a href="{{ route('index') }}">{{ config('app.name') }}</a></h1>
    <nav id="nav">
        <ul>
            <li><a href="{{ route('index') }}">Inicio</a></li>
            <li><a href="{{ route('index') . '#facultades' }}">Selecciona tu Facultad</a></li>
            <li>
                <a href="https://github.com/iksaku/FIMEats">
                    Contribuye en Github
                    <span class="fa fa-github" style="font-size: 30px; margin: 6px 0 0 6px;"></span>
                </a>
            </li>
        </ul>
    </nav>
</header>