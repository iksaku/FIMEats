<template>
    <div class="min-h-screen h-full w-full flex flex-col bg-gray-100">
        <navbar class="sticky top-0 inset-x-0 px-6 py-2" />

        <div class="flex-grow p-2">
            <slot />
        </div>
    </div>
</template>

<script>
    import Navbar from "./partials/Navbar";

    export default {
        components: {
            Navbar
        }
    }
</script>
