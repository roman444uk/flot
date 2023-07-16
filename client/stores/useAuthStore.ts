import {defineStore} from "pinia";
import {useApiFetch} from "~/composables/useApiFetch";

type User = {
    id: number;
    name: string;
    email: string;
};

type LoginCredentials = {
    email: string;
    password: string;
};

type RegisterCredentials = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
};

export const useAuthStore = defineStore('auth', () => {
    const user = ref<User | null>(null)

    const isLoggedIn = computed(() => !!user.value);

    async function register(credentials: RegisterCredentials) {
        await useApiFetch('/sanctum/csrf-cookie');

        const response = await useApiFetch('/register', {
            method: 'POST',
            body: credentials,
        });

        return response;
    }

    async function login(credentials: LoginCredentials) {
        await useApiFetch('/sanctum/csrf-cookie');

        const response = await useApiFetch('/login', {
            method: 'POST',
            body: credentials,
        });

        await fetchUser();

        return response;
    }

    async function fetchUser() {
        const {data, error} = await useApiFetch('/api/user');

        user.value = data.value as User;
    }

    async function logout() {
        await useApiFetch('/logout', {
            method: 'POST',
        });

        user.value = null;
        navigateTo('/login');
    }

    return {user, isLoggedIn, register, login, fetchUser, logout};
})
