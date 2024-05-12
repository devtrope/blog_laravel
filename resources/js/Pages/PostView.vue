<template>
     <div class="flex gap-16">
        <div class="w-[25%]">
            <div class="text-md text-slate-800 font-semibold mb-8">Articles similaires</div>
        </div>
        <div class="w-[75%]">
            <h1 class="lg:text-5xl sm:text-lg font-black text-slate-800 lg:leading-[60px] sm:leading-normal mb-4">{{ post.title }}</h1>
            <div class="text-sm text-slate-700">{{ moment(String(post.created_at )).format('LL') }}</div>
            <div class="text-xs text-slate-500 mb-2" v-if="post.created_at != post.updated_at">Mis à jour le {{ moment(String(post.updated_at )).format('LL') }} à {{ moment(String(post.updated_at )).format('LT') }}</div>
            <div class="text-indigo-700 font-semibold text-sm">{{ post.category }}</div>
            <img :src="'../storage/' + post.picture" class="w-full aspect-video object-cover mb-16 shadow-2xl rounded-sm mt-8">
            <div class="text-lg text-slate-800 leading-6 mt-8" v-html="post.content"></div>
        </div>
    </div>
</template>

<script setup>
    import { useRoute } from 'vue-router'
    import { ref, onBeforeMount } from 'vue'
    import moment from 'moment'
    import 'moment/dist/locale/fr'

    const route = useRoute()
    const post = ref({})

    onBeforeMount(() =>
    {
        axios.get('/api/posts/' + route.params.id)
        .then(response => response.data)
        .then(data => post.value = data.post)
    })
</script>