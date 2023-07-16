<script lang="ts" setup>
import {useAuthStore} from "~/stores/useAuthStore";

const auth = useAuthStore()

async function handleLogout() {
    await auth.logout();
}
</script>

<template>
    <div>
        <h3 v-if="auth.isLoggedIn">
            {{ auth.user.name }} ({{ auth.user.email }})
            <NuxtLink to="/logout" @click="handleLogout">Выйти</NuxtLink>
        </h3>

        <ul>
            <li v-if="!auth.user">
                <NuxtLink to="/login">Войти</NuxtLink>
            </li>
            <li v-if="!auth.user">
                <NuxtLink to="/register">Зарегистрироваться</NuxtLink>
            </li>
            <li v-if="auth.user">
                <NuxtLink to="/ad">Список объявлений</NuxtLink>
            </li>
            <li v-if="auth.user">
                <NuxtLink to="/ad/create">Создать объявление</NuxtLink>
            </li>
        </ul>
        <slot/>
    </div>
</template>

<style scoped></style>
