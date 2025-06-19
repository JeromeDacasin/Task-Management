// src/stores/authStore.ts
import { defineStore } from 'pinia'
import api from './../../services/config';
import type { AxiosResponse } from 'axios'

interface User {
  id: number
  name: string
  email: string
  is_admin?: boolean
}

interface LoginAuth {
  email: string
  password: string
}

interface RegisterAuth {
  name: string
  email: string
  password: string
  password_confirmation: string
}

interface AuthState {
  user: User | null
  token: string | null
}

export const useAuthStore = defineStore('auth', {
    state: (): AuthState => ({
        user: null,
        token: null
    }),

    actions: {
        async fetchUser() {
            try {
                const response: AxiosResponse<User> = await api.get('/api/user')
                this.user = response.data
            } catch {
                this.user = null
            }
        },

        async login(credentials: LoginAuth) {
            await api.get('/sanctum/csrf-cookie')
            const response = await api.post('/api/v1/auth/login', credentials)
            this.user = response.data.data.user
            this.token = response.data.data.token
        },

        async register(payload: RegisterAuth) {
            await api.get('/sanctum/csrf-cookie')
            await api.post('/api/register', payload)
        },

        async logout() {
            await api.post('/api/logout')
            this.$reset()
        }
    },

    persist: {
        storage: sessionStorage,
        paths: ['user', 'token']
    }
})