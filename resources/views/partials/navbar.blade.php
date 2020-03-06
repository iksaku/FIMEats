<header class="w-full z-30 sticky top-0 inset-x-0 text-gray-100 bg-green-700 px-6 py-2 shadow">
    <nav class="w-full flex items-center justify-between">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold inline-block align-middle">
                {{ config('app.name') }}
            </h1>
        </a>

        <div class="hidden sm:flex items-center">
            <a
                class="w-full block whitespace-no-wrap mr-10"
                href="{{ route('home') . '#facultades' }}"
                aria-label="Ir la pantalla de selección de facultades"
            >
                Selecciona tu Facultad
            </a>

            <a
                class="w-full block whitespace-no-wrap"
                href="https://github.com/iksaku/FIMEats"
                target="_blank"
                rel="noopener"
                aria-label="Ir al repositorio de Github de FIMEats"
            >
                <span class="inline-block align-middle">
                    Contribuye en Github
                </span>

                <span class="inline-block align-middle fab fa-github text-lg"></span>
            </a>
        </div>

        <div
            x-data="{ open: false }"
            class="flex items-center justify-end sm:hidden"
        >
            <button
                class="text-xl focus:outline-none"
                @click="open = !open"
            >
                <span class="fas fa-bars"></span>
            </button>

            <div class="relative">
                <div
                    x-cloak
                    x-show="open"
                    x-transition:enter="transform duration-200"
                    x-transition:enter-start="-translate-y-4 opacity-0"
                    x-transition:leave="transform duration-200"
                    x-transition:leave-end="-translate-y-4 opacity-0"
                    @click="open = false"
                    @click.away="open = false"
                    class="min-w-full z-40 absolute top-0 right-0 text-center text-gray-800 bg-gray-100 px-4 py-2 mt-3 border rounded-lg shadow"
                >
                    <a
                        class="w-full block whitespace-no-wrap pb-2 mb-2 border-b border-gray-300"
                        href="{{ route('home') . '#facultades' }}"
                        aria-label="Ir la pantalla de selección de facultades"
                    >
                        Selecciona tu Facultad
                    </a>

                    <a
                        class="w-full block whitespace-no-wrap"
                        href="https://github.com/iksaku/FIMEats"
                        target="_blank"
                        rel="noopener"
                        aria-label="Ir al repositorio de Github de FIMEats"
                    >
                        <span class="inline-block align-middle fab fa-github text-lg"></span>

                        <span class="inline-block align-middle">
                            Contribuye en Github
                        </span>
                    </a>
                </div>
            </div>
        </div>

        {{--<div class="flex justify-end text-lg">
            <a
                href="https://github.com/iksaku/FIMEats"
                target="_blank"
                rel="noopener"
                aria-label="Abre el repositorio de Github del proyecto FIMEats"
            >
                <span class="hidden sm:inline-block align-middle">
                    Contribuye en Github
                </span>

                <span class="fab fa-github inline-block align-middle text-2xl sm:text-xl"></span>
            </a>
        </div>--}}
    </nav>
</header>
