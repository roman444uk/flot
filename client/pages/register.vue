<script lang="ts" setup>
import {useAuthStore} from "~/stores/useAuthStore";
import {collectErrorsFromResponse} from "~/utils/collectErrorsFromResponse";

definePageMeta({
    middleware: ['guest']
});

const registerForm = ref({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const errors = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const auth = useAuthStore()
const registerSuccess = ref(false);

async function handleRegister() {
    const response = await auth.register(registerForm.value);
    const hasErrors = collectErrorsFromResponse(response, errors);

    if (!hasErrors) {
        registerSuccess.value = true;
    }
}
</script>

<template>
    <div>
        Регистрация:<br><br>
        <form v-if="!registerSuccess" @submit.prevent="handleRegister">
            <div>
                <label>
                    Имя:
                    <input type="text" v-model="registerForm.name">
                </label>
                <p v-if="errors.name">{{ errors.name }}</p>
            </div>
            <br><br>
            <div>
                <label>
                    Email:
                    <input type="email" v-model="registerForm.email">
                </label>
                <p v-if="errors.email">{{ errors.email }}</p>
            </div>
            <br><br>
            <div>
                <label>
                    Пароль:
                    <input type="password" v-model="registerForm.password">
                </label>
                <p v-if="errors.password">{{ errors.password }}</p>
            </div>
            <br><br>
            <div>
                <label>
                    Подтверждение пароля:
                    <input type="password" v-model="registerForm.password_confirmation">
                </label>
                <p v-if="errors.password_confirmation">{{ errors.password_confirmation }}</p>
            </div>
            <br><br>
            <button>Войти</button>
        </form>
        <h2 v-if="registerSuccess">
            Вы успешно зарегистрировались!
        </h2>
    </div>
</template>

<style scoped></style>
