<template>
    <layout :contentCenter="true">
        <template v-slot:title>
            {{ code }}
        </template>
        <template v-slot:description>
            {{ message }}
        </template>
    </layout>
</template>

<script>
import Layout from "../components/partials/Layout";

export default {
    name: "Error",

    components: {
        Layout
    },

    props: {
        code: {
            type: Number,
            default: 404
        },
        message: {
            type: String,
            default: "No se encontró el recurso."
        }
    },

    metaInfo() {
        return {
            title: `${this.code}`,
            meta: [
                {
                    vmid: "description",
                    name: "description",
                    content:
                        "Has encontrado un lugar desconocido... Porfavor regresa inmediatamente."
                },
                {
                    vmid: "prerender-status-code",
                    name: "prerender-status-code",
                    content: `${this.code}`
                }
            ]
        };
    }
};
</script>
