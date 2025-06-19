<template>
  <div class="p-4 border rounded shadow-sm bg-white">
    <div class="flex justify-between items-start">
      <div>
        <h3 class="font-bold">{{ task.title }}</h3>
        <p class="text-sm text-gray-600">{{ task.description }}</p>
        <span :class="priorityColor(task.priority)" class="text-xs font-semibold uppercase">
          {{ task.priority }}
        </span>
      </div>
      <div class="space-x-2">
        <button @click="toggleStatus" class="text-green-500">✓</button>
        <button @click="$emit('delete')" class="text-red-500">🗑</button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import type { Task } from '@/stores/taskStore'
import { useTaskStore } from '@/stores/taskStore'

const props = defineProps<{ task: Task }>()
const emit = defineEmits(['delete'])

const store = useTaskStore()

const toggleStatus = () => {
  store.updateTask(props.task.id, {
    status: props.task.status === 'completed' ? 'pending' : 'completed'
  })
}

const priorityColor = (p: Task['priority']) => {
  return {
    low: 'text-green-500',
    medium: 'text-yellow-500',
    high: 'text-red-500'
  }[p]
}
</script>
