import { createRouter, createWebHistory } from 'vue-router'
import Ballina from '../views/Ballina.vue'
import Kontakti from '@/views/Kontakti.vue'

const routes = [
  {
    path: '/',
    redirect:'/ballina'
  },
  {
    path: '/ballina',
    name: 'Ballina',
    component: Ballina
  },
  {
    path: '/kontakti',
    name: 'Kontakto',
    component: Kontakti
}
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
