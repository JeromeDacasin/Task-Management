<template>
    <div class="min-h-screen flex items-center justify-center">
        <form @submit.prevent="handleRegister" class="w-full max-w-md bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold mb-4">Register</h2>
                <input v-model="form.name" type="text" placeholder="Name" class="input mb-2" />
                <input v-model="form.email" type="email" placeholder="Email" class="input mb-2" />
                <input v-model="form.password" type="password" placeholder="Password" class="input mb-2" />
                <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password" class="input mb-4" />
            <button type="submit" class="btn-primary">Register</button>
        </form>
    </div>
</template>

<script setup lang="ts">
import { reactive } from 'vue'
import { useAuthStore } from '@/stores/authStore'
import { useRouter } from 'vue-router'

const auth = useAuthStore()
const router = useRouter()

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

const handleRegister = async () => {
  try {
    await auth.register(form)
    router.push('/')
  } catch (e) {
    alert('Registration failed')
  }
}
</script>
