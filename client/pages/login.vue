<script lang="ts" setup>
import {useAuthStore} from "~/stores/useAuthStore";
import {collectErrorsFromResponse} from "~/utils/collectErrorsFromResponse";

definePageMeta({
    middleware: ['guest']
});

const loginForm = ref({
    email: '',
    password: '',
});

const errors = reactive({
    email: '',
    password: '',
});

const auth = useAuthStore()

async function handleLogin() {
    const response = await auth.login(loginForm.value);
    const hasErrors = collectErrorsFromResponse(response, errors);

    if (!hasErrors) {
        navigateTo('/ad');
    }
}
</script>

<template>
    <div>
        <form @submit.prevent="handleLogin">
            <h2>Авторизация:</h2>
            <div>
                <label>
                    Email:
                    <input type="email" v-model="loginForm.email">
                </label>
                <p v-if="errors.email">{{ errors.email }}</p>
            </div>
            <br><br>
            <div>
                <label>
                    Логин:
                    <input type="password" v-model="loginForm.password">
                </label>
                <p v-if="errors.password">{{ errors.password }}</p>
            </div>
            <br><br>
            <button>Войти</button>
        </form>
    </div>
</template>

<style scoped></style>
