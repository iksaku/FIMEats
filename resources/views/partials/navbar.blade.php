<header class="w-full z-50 sticky top-0 inset-x-0 text-gray-100 bg-green-700 px-6 py-2 shadow">
    <nav class="w-full flex items-center justify-between">
        <a href="{{ route('home') }}">
            <h1 class="text-2xl font-bold inline-block align-middle">
                {{ config('app.name') }}
            </h1>
        </a>

        <div class="flex justify-end text-lg">
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
        </div>
    </nav>
</header>
