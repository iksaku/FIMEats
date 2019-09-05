<template>
    <div class="resource-card w-full sm:w-1/2 p-6">
        <inertia-link
            :href="route('product.show', name.toLowerCase())"
            class="w-full block text-center hover:shadow-outline"
        >
            <img
                class="product-img rounded-lg mx-auto"
                :src="image"
                :alt="`Representative image of ${name}`"
            >

            <div class="text-center text-gray-700 text-xl my-2">
                <span v-if="quantity" class="inline-block align-middle">
                    {{ quantity }}
                </span>
                <span v-if="quantity" class="inline-block align-top mx-1">
                    &verbar;
                </span>
                <span class="inline-block align-middle">
                    ${{ price }}
                </span>
            </div>

            <h3 class="text-center text-gray-700 text-xl uppercase">
                <span class="inline-block align-bottom">
                    {{ name }}
                </span>
            </h3>
        </inertia-link>
    </div>
</template>

<script>
    export default {
        name: "ProductCard",

        inheritAttrs: false,

        props: {
            name: String,
            quantity: String,
            price: String,
            image: String,
            categories: Array
        }
    }
</script>
