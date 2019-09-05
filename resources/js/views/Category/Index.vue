<template>
    <layout>
        <h1>Category List</h1>
        <ul class="list-disc px-4">
            <li
                v-for="(name, index) in categories"
                :key="index"
            >
                <a :href="route('category.show', name.toLowerCase())">
                    {{ name }}
                </a>
            </li>
        </ul>
    </layout>
</template>

<script>
    import Layout from "../../components/partials/Layout"

    export default {
        name: "Category/Index",

        components: {
            Layout
        },

        props: {
            categories: Array
        }
    }
</script>
