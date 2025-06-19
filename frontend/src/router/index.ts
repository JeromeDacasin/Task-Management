import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/Login.vue'
import Register from '../views/Register.vue'
import Admin from '../views/Admin.vue'
import { useAuthStore } from '@/stores/authStore'

const routes = [
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  {
    path: '/admin',
    component: Admin,
    meta: { requiresAuth: true, adminOnly: true }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

router.beforeEach(async (to, from, next) => {
    const authStore = useAuthStore()
    if (!authStore.user) {
        try {
            await authStore.fetchUser()
        } catch {
            if (to.meta.requiresAuth) return next('/login')
        }
    }
    if (to.meta.adminOnly && authStore.user?.is_admin !== 'admin') {
        return next('/')
    }
  next()
})

export default router
