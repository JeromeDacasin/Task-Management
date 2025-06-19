<template>
  <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-4">
    <form
      @submit.prevent="handleLogin"
      class="w-full sm:max-w-md bg-white p-8 sm:p-10 rounded-xl shadow-lg"
    >
      <div class="text-center mb-8">
        <h2 class="text-3xl font-extrabold text-gray-800">Welcome Back</h2>
        <p class="mt-2 text-gray-600">Sign in to your account</p>
      </div>

      <div class="space-y-5">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input
            id="email"
            v-model="form.email"
            type="email"
            placeholder="you@example.com"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            required
          />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <input
            id="password"
            v-model="form.password"
            type="password"
            placeholder="••••••••"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
            required
          />
        </div>

        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <input
              id="remember-me"
              type="checkbox"
              class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
            />
            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Remember me</label>
          </div>
          <a href="#" class="text-sm text-blue-600 hover:text-blue-500">Forgot password?</a>
        </div>

        <button
          type="submit"
          :disabled="loading"
          class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 disabled:opacity-70 disabled:cursor-not-allowed"
        >
          <span v-if="!loading">Sign In</span>
          <span v-else>Signing in...</span>
        </button>
      </div>

      <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
          Don't have an account? 
          <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Sign up</a>
        </p>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { reactive, ref } from 'vue'
import { useAuthStore } from '@/stores/authStore'
import { useRouter } from 'vue-router'

const auth = useAuthStore()
const router = useRouter()
const loading = ref(false)

const form = reactive({
  email: '',
  password: ''
})

const handleLogin = async () => {
  try {
    loading.value = true
    await auth.login({
      email: form.email,
      password: form.password
    })
    router.push('/')
  } catch (error) {
    alert('Login failed. Please check your credentials and try again.')
    console.error('Login error:', error)
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
input, button {
  transition: all 0.2s ease;
}

input:focus {
  box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
}

button:hover {
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}
</style>