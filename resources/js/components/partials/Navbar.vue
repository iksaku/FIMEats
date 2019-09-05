<template>
    <header class="w-full text-gray-100 bg-green-700 shadow">
        <nav class="w-full flex items-center justify-between">
            <inertia-link :href="route('home')">
                <h1 class="text-2xl font-bold inline-block align-middle">
                    {{ $page.app.name }}
                </h1>
            </inertia-link>

            <div class="flex justify-end text-lg">
                <a
                    href="https://github.com/iksaku/FIMEats"
                    target="_blank"
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
        name: "Navbar"
    }
</script>
