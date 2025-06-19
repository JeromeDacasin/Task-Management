<template>
  <div>
    <draggable v-model="taskStore.tasks" @end="onDragEnd" item-key="id">
      <template #item="{ element }">
        <TaskCard :task="element" @delete="taskStore.deleteTask(element.id)" />
      </template>
    </draggable>
  </div>
</template>

<script setup lang="ts">
import draggable from 'vuedraggable'
import TaskCard from './TaskCard.vue'
import { useTaskStore } from '@/stores/taskStore'

const taskStore = useTaskStore()

const onDragEnd = () => {
  taskStore.tasks.forEach((t, i) => (t.order = i + 1))
  taskStore.reorderTasks(taskStore.tasks)
}
</script>
