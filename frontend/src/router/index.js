import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import UserCabinet from '../views/UserCabinet.vue'
import Login from '@/views/Login.vue'
import Reg from '@/views/Reg.vue'
import recordPool from '@/views/recordPool.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/user-cabinet',
      name: 'UserCabinet',
      component: UserCabinet,
    },
    {
      path: '/reg',
      name: 'Reg',
      component: Reg,
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
    },
    {
      path: '/record-pool',
      name: 'recordPool',
      component: recordPool,
    }
  ],
})

export default router
