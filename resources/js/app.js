require("./fontawesome");

import Vue from "vue";
import Meta from "vue-meta";
import { InertiaApp } from "@inertiajs/inertia-vue";

Vue.config.productionTip = false;

Vue.use(InertiaApp);
Vue.use(Meta);

Vue.mixin({
    methods: {
        route // eslint-disable-line no-undef
    }
});

const app = document.getElementById("app");

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name =>
                    import(`@/views/${name}`).then(module => module.default)
            }
        })
}).$mount(app);
