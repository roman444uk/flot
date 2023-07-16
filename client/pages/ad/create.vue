<script lang="ts" setup>
import {useApiFetch} from "~/composables/useApiFetch";
import {collectErrorsFromResponse} from "~/utils/collectErrorsFromResponse";

definePageMeta({
    middleware: ['auth']
});

const createAdForm = ref({
    title: '',
});

const errors = reactive({
    title: '',
});

const photos = reactive([
    {error: ''}
]);

async function handleAddPhoto() {
    if (photos.length < 10) {
        photos.push({error: ''});
    }
}

async function handleAdCreate() {
    let formData = new FormData();
    formData.append("title", createAdForm.value.title);

    document.getElementsByName('photos').forEach((input, index) => {
        if (input.files.length) {
            formData.append("photos[]", input.files[0]);
        }
    });

    const response = await useApiFetch('/api/ad', {
        method: 'POST',
        body: formData,
    });

    const hasErrors = collectErrorsFromResponse(response, errors);

    if (!hasErrors) {
        let ad = response.data.value;
        navigateTo('/ad/' + ad.slug);
    }
}
</script>

<template>
    <div>
        <div>
            <h2>Создание объявления:</h2>
        </div>
        <form @submit.prevent="handleAdCreate">
            <div>
                <label>
                    Название:
                    <input type="text" v-model="createAdForm.title">
                </label>
                <div v-if="errors.title">{{ errors.title }}</div>
            </div>
            <br><br>
            <div>
                <label>
                    Фотографии (максимум 10 фото):
                </label>
                <div v-if="errors.photos">{{ errors.photos }}</div>
                <br><br>
                <div v-for="(photo, key) in photos">
                    {{ key + 1 }}
                    <input type="file" name="photos" :data-key="key" @change="handleAddPhoto($event)">
                    <div v-if="errors['photos.'+key]">{{ errors['photos.'+key] }}</div>
                    <br><br>
                </div>
            </div>
            <br><br>
            <button>Создать</button>
        </form>
    </div>
</template>

<style scoped></style>
