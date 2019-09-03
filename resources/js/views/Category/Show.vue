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
    import Layout from '../../components/Layout'

    export default {
        components: {
            Layout
        },

        props: {
            name: String,
            products: Array
        }
    }
</script>
