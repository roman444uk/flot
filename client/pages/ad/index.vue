<script lang="ts" setup>
import {useApiFetch} from "~/composables/useApiFetch";
import {getPhotoUrl} from "~/utils/getPhotoUrl";

definePageMeta({
    middleware: ['auth']
});

type Ad = {
    id: number;
    title: string;
    slug: string;
    photos: [],
};

const appConfig = useAppConfig();
const curPage = useRouter()?.query?.page ?? '1';

const ads = ref([]);
const adsData = ref({
    links: []
});

async function handleSetPage(page: string) {
    if (isNaN(page)) {
        return;
    }
    useRouter().replace({query: {page: page}});

    const {data} = await useApiFetch('/api/ad?page=' + page);

    adsData.value = data?.value
    ads.value = data?.value?.data;
}

handleSetPage(curPage);

async function handleShowAd(ad: Ad) {
    navigateTo('/ad/' + ad.slug);
}
</script>

<template>
    <div>
        <h2>Список объявлений:</h2>
    </div>
    <a v-for="(ad) in ads" href="#" @click.prevent="handleShowAd(ad)" style="display: block;">
        {{ ad.title }}
        <img :src="getPhotoUrl(ad.photos[0].url)"
             style="display: block; width: 100px; margin-bottom: 15px;"
        >
    </a>

    <ul v-if="adsData?.links && adsData.links.length > 3" style="list-style-type: none;">
        <li v-for="(link) in adsData?.links" style="display: inline-block; margin-left: 10px;">
            <a href="#" @click.prevent="handleSetPage(link.label)" v-html="link.label"></a>
        </li>
    </ul>
</template>

<style scoped></style>
