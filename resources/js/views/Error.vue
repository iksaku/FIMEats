<template>
    <layout>
        <h1>{{ code }}</h1>
        <p>{{ message }}</p>
    </layout>
</template>

<script>
    import Layout from '../components/Layout'

    export default {
        components: {
            Layout
        },

        props: {
            code: {
                type: Number,
                default: 404
            },
            message: String
        }
    }
</script>
