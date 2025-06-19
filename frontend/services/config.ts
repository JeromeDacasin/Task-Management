import { useAuthStore } from "@/stores/authStore";
import axios from "axios";

const api = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  withCredentials: true, 
});


api.interceptors.request.use(config => {
    const authStore = useAuthStore()
    const token = authStore.token;

    if (token && config.headers) {
        config.headers.Authorization = `Bearer ${token}`
    }

    return config;
})

api.interceptors.response.use(
    response => response,
    error => {
        if (error.response?.status === 401) {
            const authStore = useAuthStore();
            authStore.logout();
            sessionStorage.clear(); 
            window.location.href = '/login';
        }
        return Promise.reject(error);
    }
)

export default api;