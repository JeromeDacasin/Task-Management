<template>
  <div class="flex flex-col md:flex-row gap-2 mb-4">
    <select v-model="filters.status" class="input">
      <option value="">All Statuses</option>
      <option value="pending">Pending</option>
      <option value="completed">Completed</option>
    </select>

    <select v-model="filters.priority" class="input">
      <option value="">All Priorities</option>
      <option value="low">Low</option>
      <option value="medium">Medium</option>
      <option value="high">High</option>
    </select>

    <input
      v-model="filters.search"
      type="text"
      placeholder="Search by title/description"
      class="input flex-1"
    />
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits, watch } from 'vue'

interface Filters {
  status: string
  priority: string
  search: string
}

const props = defineProps<{
  modelValue: Filters
}>()

const emit = defineEmits(['update:modelValue'])

const filters = { ...props.modelValue }

watch(filters, () => {
  emit('update:modelValue', filters)
})
</script>

<style scoped>

</style>
