<template>
    <header class="w-full text-gray-100 bg-green-700 shadow">
        <nav class="w-full flex items-center justify-between">
            <inertia-link :href="route('home')">
                <h1 class="text-2xl font-bold inline-block align-middle">
                    {{ $page.app.name }}
                </h1>
            </inertia-link>

            <div class="flex justify-end text-lg">
                <!-- Must be a normal anchor tag due to unsupported hash scrolling -->
                <a
                    :href="route('home').url() + '#facultades'"
                    class="hidden sm:block"
                >
                    <span class="inline-block align-middle">
                        Selecciona tu Facultad
                    </span>
                </a>
                <a
                    href="https://github.com/iksaku/FIMEats"
                    target="_blank"
                    class="ml-4"
                >
                    <span class="hidden sm:inline-block align-middle">
                        Contribuye en Github
                    </span>
                    <fa
                        :icon="['fab', 'github']"
                        class="inline-block align-middle text-2xl sm:text-xl"
                    />
                </a>
            </div>
        </nav>
    </header>
</template>

<script>
    export default {
        mounted() {

        }
    }
</script>
