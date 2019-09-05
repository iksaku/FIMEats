<template>
    <layout>
        <template v-slot:title>
            {{ short_name }}
        </template>
        <template v-slot:description>
            {{ name }}
        </template>

        <card
            v-if="maps_url !== null"
            class="text-center flex flex-col items-center"
        >
            <h3 class="text-gray-700 text-2xl">
                ¿No sabes como llegar?
            </h3>
            <p class="text-gray-600 text-lg">
                Aquí tienes un mapa con la ubicación del lugar.
            </p>
            <iframe
                :src="maps_url"
                class="map border-0 mt-4"
                allowfullscreen
            ></iframe>
        </card>

        <card
            v-for="(cafeteria, index) in cafeterias"
            :key="index"
            class="text-center"
        >
            <div class="w-full text-center mt-2 mb-6">
                <h3 class="text-gray-700 text-2xl">
                    {{ cafeteria.name }}
                </h3>
            </div>
            <div class="h-full w-11/12 mx-auto flex flex-wrap items-center justify-center">
                <product-card
                    v-for="(product, index) in cafeteria.products"
                    :key="index"
                    v-bind="product"
                />
            </div>
        </card>
    </layout>
</template>

<script>
    import Layout from "../components/partials/Layout"
    import Card from "../components/Card"
    import ProductCard from "../components/ProductCard"

    export default {
        name: "Faculty",

        components: {
            Layout,
            Card,
            ProductCard
        },

        props: {
            name: String,
            short_name: String,
            logo: String,
            cafeterias: Array,
            maps_url: {
                type: String,
                required: false
            }
        },

        mounted() {
            document.title = this.short_name + ' | ' + this.$page.app.name
        }
    }
</script>
