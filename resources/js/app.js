require ('./fontawesome')

import Vue from 'vue'
import { InertiaApp } from '@inertiajs/inertia-vue'

Vue.config.productionTip = false

Vue.use(InertiaApp)

Vue.mixin({
    methods: {
        route: route
    }
});

const app = document.getElementById('app')

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => import(`@/views/${name}`).then(module => module.default),
        },
    }),
}).$mount(app)
