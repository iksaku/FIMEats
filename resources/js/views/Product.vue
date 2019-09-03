<template>
    <layout>
        <h1>Product</h1>
        <div
            v-for="(product, index) in products"
            :key="index"
            class="py-2 border-t-4"
        >
            <ul class="list-disc px-4">
                <li>Name: {{ product.name }}</li>
                <li>Quantity: {{ product.quantity }}</li>
                <li>Price: {{ product.price }}</li>
                <li>Image: {{ product.image }}</li>
                <li>Cafeteria: {{ product.cafeteria }}</li>
            </ul>
        </div>
    </layout>
</template>

<script>
    import Layout from '../components/Layout'

    export default {
        components: {
            Layout
        },

        props: {
            products: Array
        }
    }
</script>
