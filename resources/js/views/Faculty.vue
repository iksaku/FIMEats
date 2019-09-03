<template>
    <layout>
        <h1>Faculty</h1>
        <ul class="list-disc px-4">
            <li>Name: {{ name }}</li>
            <li>Short Name: {{ short_name }}</li>
            <li>Maps Url: {{ maps_url }}</li>
            <li>Logo Url: {{ logo }}</li>
            <li>Cafeterias (Count): {{ cafeterias.length }}</li>
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
            name: String,
            short_name: String,
            maps_url: String,
            logo: String,
            cafeterias: Array
        }
    }
</script>
