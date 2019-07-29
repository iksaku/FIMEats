import Vue from 'vue'
import Meta from 'vue-meta'
import Progressbar from 'vue-progressbar'
import Router from 'vue-router'

Vue.use(Meta)

Vue.use(Progressbar, {
    color: '#63B3ED',
    thickness: '2px',
    autoFinish: false
})

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [

    ]
})
