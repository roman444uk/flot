<script lang="ts" setup>
import {useApiFetch} from "~/composables/useApiFetch";
import {getPhotoUrl} from "~/utils/getPhotoUrl";

const route = useRoute()

definePageMeta({
    middleware: ['auth']
});

type Ad = {
    id: number;
    title: string;
    slug: string;
    photos: [],
};

const {data} = await useApiFetch('/api/ad/' + route.params.slug);


let ad = data.value as Ad;
</script>

<template>
    <div>
        <div>
            <h2>{{ ad.title }}</h2>
        </div>
        <div v-for="(photo, key) in ad.photos">
            <img :src="getPhotoUrl(photo.url)" style="width: 300px;">
        </div>
    </div>
</template>

<style scoped></style>
