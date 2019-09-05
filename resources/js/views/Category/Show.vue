<template>
    <layout>
        <h1>Category</h1>
        <ul>
            <li>Name: {{ name }}</li>
            <li>Product (Count): {{ products.length }}</li>
        </ul>
    </layout>
</template>

<script>
    import Layout from "../../components/partials/Layout"

    export default {
        name: "Category/Show",

        components: {
            Layout
        },

        props: {
            name: String,
            products: Array
        }
    }
</script>
