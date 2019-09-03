<template>
    <layout>
        <h1>Selecciona tu Facultad</h1>
        <ul class="list-disc px-4">
            <li
                v-for="(faculty, index) in faculties"
                :key="index"
            >
                <inertia-link
                    :href="route('faculty.show', faculty.short_name.toLowerCase())"
                >
                    {{ faculty.name }}
                </inertia-link>
            </li>
        </ul>
    </layout>
</template>

<script>
    import Layout from '../components/Layout'

    export default {
        components: {
            Layout
        },

        props: {
            faculties: Array
        }
    }
</script>
