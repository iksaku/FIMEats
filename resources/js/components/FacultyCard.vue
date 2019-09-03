<template>
    <inertia-link
        :href="route('faculty.show', short_name.toLowerCase())"
        class="faculty-card w-full sm:w-1/2 py-6 border-t-2 border-gray-300 text-center hover:shadow-outline focus:outline-none focus:shadow-outline"
    >
        <img
            class="h-48 w-48 rounded-lg mx-auto"
            :src="logo"
            :alt="`Logo of ${short_name} Faculty`"
        >
        <h3 class="text-center text-gray-700 text-xl uppercase mt-2">
            {{ short_name }}
        </h3>
    </inertia-link>
</template>

<script>
    export default {
        inheritAttrs: false,

        props: {
            name: String,
            short_name: String,
            logo: String
        }
    }
</script>

<style scoped>

</style>
