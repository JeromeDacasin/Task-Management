<template>
  <div class="p-4 max-w-3xl mx-auto">
    <h2 class="text-xl font-bold mb-4">My Tasks</h2>

    <StatsBar />
    <FilterBar v-model="filters" />

    <TaskList :tasks="filteredTasks" />
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import StatsBar from '@/components/tasks/StatsBar.vue'
import FilterBar from '@/components/tasks/FilterBar.vue'
import TaskList from '@/components/tasks/TaskList.vue'
import { useTaskStore } from '@/stores/taskStore'

const taskStore = useTaskStore()

const filters = ref({
  status: '',
  priority: '',
  search: ''
})

onMounted(() => {
  taskStore.fetchTasks()
})

const filteredTasks = computed(() =>
  taskStore.tasks.filter(task => {
    const matchStatus = !filters.value.status || task.status === filters.value.status
    const matchPriority = !filters.value.priority || task.priority === filters.value.priority
    const matchSearch =
      !filters.value.search ||
      task.title.toLowerCase().includes(filters.value.search.toLowerCase()) ||
      task.description.toLowerCase().includes(filters.value.search.toLowerCase())

    return matchStatus && matchPriority && matchSearch
  })
)
</script>
