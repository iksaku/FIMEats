<template>
    <layout>
        <template v-slot:title>
            Compara los Precios
        </template>

        <card>
            <div
                class="overflow-hidden overflow-x-auto border border-gray-300 rounded"
            >
                <table class="table w-full" cellspacing="0" cellpadding="0">
                    <thead
                        class="bg-green-700 text-white border-b border-gray-300"
                    >
                        <tr>
                            <td class="w-1/3 text-center p-2">Nombre</td>
                            <td class="w-1/6 text-center p-2">Cantidad</td>
                            <td class="w-1/3 text-center p-2">Cafetería</td>
                            <td class="w-1/6 text-center p-2">Precio</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(product, index) in products"
                            :key="index"
                            class="bg-green-100 hover:bg-green-200 border-b border-gray-300 first:border-dashed first:border-b-4"
                        >
                            <td class="whitespace-no-wrap p-2">
                                {{ product.name }}
                            </td>
                            <td class="whitespace-no-wrap text-center p-2">
                                {{ product.quantity || "-" }}
                            </td>
                            <td class="whitespace-no-wrap p-2">
                                <inertia-link
                                    :href="
                                        route(
                                            'faculty.show',
                                            product.cafeteria.faculty.short_name
                                        )
                                    "
                                    class="underline hover:no-underline focus:no-underline"
                                >
                                    {{ product.cafeteria.name }}
                                </inertia-link>
                            </td>
                            <td class="whitespace-no-wrap p-2">
                                ${{ product.price }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </card>
    </layout>
</template>

<script>
import Layout from "../components/partials/Layout";
import Card from "../components/Card";

export default {
    name: "Product",

    components: {
        Layout,
        Card
    },

    props: {
        name: String,
        products: Array
    },

    metaInfo: {
        title: "Comparar Productos",
        meta: [
            {
                vmid: "description",
                name: "description",
                content:
                    "Compara los precios de un mismo producto entre todas las Facultades que lo venden."
            }
        ]
    }
};
</script>
