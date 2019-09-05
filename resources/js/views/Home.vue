<template>
    <layout>
        <template v-slot:title>
            {{ $page.app.name }}
        </template>
        <template v-slot:description>
            La comida que buscas, en el lugar que buscas.
        </template>

        <card>
            <div class="w-full text-center mt-2 mb-6">
                <h2 class="text-gray-700 text-2xl">
                    Selecciona tu Facultad
                </h2>
            </div>
            <div class="h-full w-11/12 mx-auto flex flex-wrap">
                <faculty-card
                    v-for="(faculty) in faculties"
                    :key="faculty.short_name"
                    v-bind="faculty"
                />
            </div>
        </card>
    </layout>
</template>

<script>
    import Layout from "../components/partials/Layout"
    import Card from "../components/Card"
    import FacultyCard from "../components/FacultyCard"

    export default {
        name: "Home",

        components: {
            Layout,
            Card,
            FacultyCard
        },

        props: {
            faculties: Array
        }
    }
</script>
