<template>
  <div class="flex justify-between bg-gray-100 p-3 rounded mb-4 text-sm font-medium">
    <div>Total Tasks: {{ total }}</div>
    <div>Completed: {{ completed }}</div>
    <div>Pending: {{ pending }}</div>
  </div>
</template>

<script setup lang="ts">
import { computed } from 'vue'
import { useTaskStore } from '@/stores/taskStore'

const taskStore = useTaskStore()

const total = computed(() => taskStore.tasks.length)
const completed = computed(() => taskStore.tasks.filter(t => t.status === 'completed').length)
const pending = computed(() => taskStore.tasks.filter(t => t.status === 'pending').length)
</script>
