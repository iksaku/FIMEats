<template>
    <div class="min-h-screen h-full w-full flex flex-col bg-gray-100">
        <navbar class="sticky top-0 inset-x-0 px-6 py-2" />

        <div class="flex-grow p-2">
            <div class="w-full py-10">
                <div class="max-w-xl mx-auto text-center">
                    <h1 class="text-gray-700 text-4xl">
                        <slot name="title" />
                    </h1>
                    <hr class="my-4 border-t-2">
                    <p class="text-gray-700 text-xl">
                        <slot name="description" />
                    </p>
                </div>
            </div>

            <slot />
        </div>
    </div>
</template>

<script>
    import Navbar from "./Navbar"

    export default {
        name: "Layout",

        components: {
            Navbar
        },

        mounted() {
            document.title = this.$page.app.name
        }
    }
</script>
