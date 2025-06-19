import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import axios from 'axios'

export interface Task {
  id: number
  title: string
  description: string
  status: 'pending' | 'completed'
  priority: 'low' | 'medium' | 'high'
  order: number
  user_id: number
}

export const useTaskStore = defineStore('tasks', () => {
  const tasks = ref<Task[]>([])
  const isLoading = ref(false)

  const fetchTasks = async () => {
    isLoading.value = true
    const response = await axios.get('/api/tasks')
    tasks.value = response.data
    isLoading.value = false
  }

  const createTask = async (task: Partial<Task>) => {
    const response = await axios.post('/api/tasks', task)
    tasks.value.push(response.data)
  }

  const updateTask = async (id: number, task: Partial<Task>) => {
    const response = await axios.put(`/api/tasks/${id}`, task)
    const index = tasks.value.findIndex(t => t.id === id)
    if (index !== -1) tasks.value[index] = response.data
  }

  const deleteTask = async (id: number) => {
    await axios.delete(`/api/tasks/${id}`)
    tasks.value = tasks.value.filter(t => t.id !== id)
  }

  const reorderTasks = async (orderedTasks: Task[]) => {
    tasks.value = orderedTasks
    await axios.post('/api/tasks/reorder', { tasks: orderedTasks.map(t => ({ id: t.id, order: t.order })) })
  }

  const filteredTasks = computed(() => tasks.value.slice().sort((a, b) => a.order - b.order))

  return {
    tasks,
    isLoading,
    fetchTasks,
    createTask,
    updateTask,
    deleteTask,
    reorderTasks,
    filteredTasks
  }
})
