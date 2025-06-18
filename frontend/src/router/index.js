import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import UserCabinet from '../views/UserCabinet.vue'
import Login from '@/views/Login.vue'
import Reg from '@/views/Reg.vue'
import Record from '@/views/Record.vue'
import N404 from '@/views/404/NotFound.vue'
import Admin from '@/views/Admin.vue'

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
      path: '/record',
      name: 'Record',
      component: Record,
    },
    {
      path: '/admin',
      name: 'Admin',
      component: Admin,
    },
    // {
    //   path: '/admin',
    //   component: Admin,
    //   children: [
    //     {
    //       path: '',
    //       component: AdminRequests
    //     },
    //     {
    //       path: 'dashboard',
    //       component: Dashboard
    //     },
    //     {
    //       path: 'add-tour',
    //       component: AddTour
    //     },
    //     {
    //       path: 'edit-tour-list',
    //       component: EditTourList
    //     },
    //     {
    //       path: 'edit-tour/:id_tour',
    //       component: EditTour
            // this.id_tour = this.$route.params.id_tour
    //     },
    //     {
    //       path: 'delete-tour',
    //       component: DeleteTour
    //     },
    //   ]
    // },
    {
      path: '/:pathMatch(.*)',
      name: 'N404',
      component: N404,
    }
  ],
})

export default router
