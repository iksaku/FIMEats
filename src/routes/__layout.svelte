<script>
    import '$assets/app.css'
    import Github from '$components/Icons/Github.svelte'
    import Menu from '$components/Icons/Menu.svelte'

    import Favicon from '$components/Favicon.svelte'

    let open = false

    function toggleMenu() {
        open = !open
    }

    function closeMenu() {
        open = false
    }
</script>

<Favicon />

<header class='w-full z-30 sticky top-0 inset-x-0 text-gray-100 bg-green-700 px-6 py-2 shadow'>
    <nav class='w-full flex items-center justify-between'>
        <a href='/'>
            <h1 class='text-2xl font-bold inline-block align-middle'>FIMEats</h1>
        </a>

        <div class='hidden sm:flex items-center space-x-10'>
            <a
                href='/#facultades'
                class='inline-block flex-none'
                aria-label='Ir a la pantalla de selección de facultades.'
            >
                Selecciona tu Facultad
            </a>

            <a
                class='inline-flex items-center flex-none space-x-1'
                href='https://github.com/iksaku/FIMEats'
                target='_blank'
                rel='noopener'
                aria-label='Ir al repositorio de Github de FIMEats.'
            >
                <span>Contribuye en Github</span>

                <Github class='w-5 h-5' />
            </a>
        </div>

        <div class='flex items-center justify-end sm:hidden'>
            <button class='focus:outline-none' on:click={toggleMenu}>
                <Menu class='w-8 h-8' />
            </button>

            <div class='relative'>
                {#if open}
                    <div
                        on:click={closeMenu}
                        class='w-56 z-40 absolute top-0 right-0 text-center text-gray-800 bg-white mt-3 border rounded-lg shadow divide-y divide-gray-300'
                    >
                        <a
                            href='/#facultades'
                            class='w-full block whitespace-no-wrap px-4 py-2'
                            aria-label='Ir a la pantalla de selección de facultades.'
                        >
                            Selecciona tu Facultad
                        </a>

                        <a
                            class='w-full flex items-center whitespace-no-wrap space-x-1 px-4 py-2'
                            href='https://github.com/iksaku/FIMEats'
                            target='_blank'
                            rel='noopener'
                            aria-label='Ir al repositorio de Github de FIMEats'
                        >
                            <Github class='w-5 h-5' />

                            <span> Contribuye en Github </span>
                        </a>
                    </div>
                {/if}
            </div>
        </div>
    </nav>
</header>

<slot></slot>
