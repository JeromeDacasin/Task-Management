<template>
  <div class="border p-4 rounded shadow">
    <h3 class="text-lg font-bold">{{ user.name }}</h3>
    <p class="text-sm text-gray-500">{{ user.email }}</p>

    <ul class="mt-2 text-sm">
      <li>Total Tasks: {{ user.total_tasks }}</li>
      <li>Completed: {{ user.completed_tasks }}</li>
      <li>Pending: {{ user.pending_tasks }}</li>
    </ul>
  </div>
</template>

<script setup lang="ts">
defineProps<{
  user: {
    id: number
    name: string
    email: string
    total_tasks: number
    completed_tasks: number
    pending_tasks: number
  }
}>()
</script>
