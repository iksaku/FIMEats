<template>
    <div class="min-h-screen h-full w-full flex flex-col bg-gray-100">
        <navbar class="sticky top-0 inset-x-0 px-6 py-2" />

        <div class="flex-grow p-2">
            <div class="w-full py-10" :class="{ 'h-full': this.contentCenter }">
                <div
                    class="max-w-xl mx-auto text-center"
                    :class="
                        this.contentCenter
                            ? 'h-full flex flex-col items-center justify-center'
                            : ''
                    "
                >
                    <h1 class="text-gray-700 text-4xl">
                        <slot name="title" />
                    </h1>
                    <hr class="w-full my-4 border-t-2" />
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
import Navbar from "./Navbar";

export default {
    name: "Layout",

    components: {
        Navbar
    },

    props: {
        contentCenter: Boolean
    },

    metaInfo() {
        return {
            titleTemplate: `%s | ${this.$page.app.name}`
        };
    }
};
</script>
