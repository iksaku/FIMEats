<template>
    <layout>
        <div class="w-ful py-10">
            <div class="max-w-xl mx-auto text-center">
                <h1 class="text-gray-700 text-4xl">
                    {{ $page.app.name }}
                </h1>
                <hr class="my-4 border-t-2">
                <p class="text-gray-700 text-xl">
                    La comida que buscas, en el lugar que buscas.
                </p>
            </div>
        </div>

        <div class="w-full mx-auto p-4 sm:w-10/12 bg-white border-t border-b sm:border border-gray-300 sm:rounded-lg">
            <div class="w-full text-center mt-2 mb-6">
                <h2 id="facultades" class="text-gray-700 text-2xl">Selecciona tu Facultad</h2>
            </div>
            <div class="h-full w-11/12 mx-auto flex flex-wrap">
                <faculty-card
                    v-for="(faculty) in faculties"
                    :key="faculty.short_name"
                    v-bind="faculty"
                />
            </div>
        </div>
    </layout>
</template>

<script>
    import Layout from '../components/Layout'
    import FacultyCard from "../components/FacultyCard";

    export default {
        components: {
            Layout,
            FacultyCard
        },

        props: {
            faculties: Array
        }
    }
</script>
