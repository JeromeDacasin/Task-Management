// import Echo from 'laravel-echo'
// import Pusher from 'pusher-js'
// import { useTasksStore } from '../stores/tasks'

// window.Pusher = Pusher

// const echo = new Echo({
//   broadcaster: 'pusher',
//   key: import.meta.env.VITE_PUSHER_APP_KEY,
//   cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//   forceTLS: true
// })

// echo.channel('tasks')
//   .listen('TaskCreated', (e: any) => {
//     const store = useTasksStore()
//     store.tasks.push(e.task)
//   })
//   .listen('TaskUpdated', (e: any) => {
//     const store = useTasksStore()
//     const index = store.tasks.findIndex(t => t.id === e.task.id)
//     if (index !== -1) store.tasks[index] = e.task
//   })