<template>
  <div class="p-4 max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Admin Dashboard</h2>
    <div v-if="loading" class="text-center py-10">Loading users...</div>

    <div v-else>
      <div class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <UserTaskStatsCard
          v-for="user in users"
          :key="user.id"
          :user="user"
        />
      </div>

      <div class="mt-6 text-center">
        <button class="btn-primary" @click="fetchMore" v-if="hasMore">Load More</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue'
import UserTaskStatsCard from '@/components/admin/UserTaskStatsCard.vue'
import axios from 'axios'

const users = ref<any[]>([])
const loading = ref(false)
const page = ref(1)
const hasMore = ref(true)

const fetchUsers = async () => {
  loading.value = true
  const { data } = await axios.get(`/api/admin/users?page=${page.value}`)
  if (data.data.length < 1) hasMore.value = false
  users.value.push(...data.data)
  loading.value = false
}

const fetchMore = () => {
  page.value++
  fetchUsers()
}

onMounted(fetchUsers)
</script>
