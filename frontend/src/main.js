import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './assets/index.scss'
import { createPinia } from 'pinia'

const app = createApp(App)

const pinia = createPinia() 

app.use(router).use(pinia)

app.mount('#app')
