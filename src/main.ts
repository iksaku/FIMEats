import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/app.css'
import { setup } from '@/api/database/setup'

const app = createApp(App).use(router)

setup().then(() => {
  app.mount('#app')
})
