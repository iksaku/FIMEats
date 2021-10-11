import { createRouter, createWebHistory } from 'vue-router'
import routes from 'virtual:generated-pages'

export default createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, _, savedPosition) {
    if (to.hash) {
      return {
        el: to.hash,
        behavior: 'smooth',
      }
    }

    return savedPosition ?? { top: 0 }
  },
})
