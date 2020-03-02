<template>

</template>

<script>
import Navbar from "./Navbar";

export default {
    name: "Layout",

    components: {
        Navbar
    },

    props: {
        contentCenter: Boolean
    },

    metaInfo() {
        return {
            titleTemplate: `%s | ${this.$page.app.name}`
        };
    }
};
</script>
