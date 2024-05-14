<template>
    <div v-if="isLoading" class="animate-pulse">
        <div class="bg-gray-300 h-5 w-20 rounded-full"></div>
        <div class="bg-gray-300 h-5 rounded-full mt-4 mb-2"></div>
        <div class="bg-gray-300 h-5 rounded-full mb-2"></div>
        <div class="bg-gray-300 h-5 rounded-full mb-6 w-1/2"></div>
        <div class="bg-gray-300 aspect-video rounded-sm mt-12"></div>
    </div>
    <div v-if="!isLoading">
        <div>
            <span class="text-sm bg-indigo-100 text-indigo-700 py-1 px-3 rounded-full">{{ category.name }}</span>
            <h1 class="lg:text-5xl xs:text-3xl font-black text-slate-800 my-4">{{ post.title }}</h1>
            <img :src="'/storage/' + post.picture" class="w-full aspect-video object-cover mb-16 shadow-2xl rounded-sm mt-8">
        </div>
         <div class="xl:flex gap-16 w-11/12 m-auto sm:block">
            <div class="xl:w-[75%] sm:w-full">
                <div class="text-sm text-slate-700">{{ moment(String(post.created_at)).format('LL') }}</div>
                <div class="text-xs text-slate-500 mb-2" v-if="post.created_at != post.updated_at">Mis à jour le {{ moment(String(post.updated_at )).format('LL') }} à {{ moment(String(post.updated_at )).format('LT') }}</div>
                <div class="text-lg text-slate-800 leading-7 mt-8" v-html="post.content"></div>
            </div>
            <div class="xl:w-[25%] sm:w-full">
                <div class="text-md text-slate-800 font-semibold mb-8 sm:mt-24 pb-2 border-b-2 border-solid border-gray-900">Articles similaires</div>
                <RouterLink :to="'/post/' + similar.id" v-for="similar in similars" :key="similar.id" class="block mb-8 pb-8 border-b border-slate-300 border-solid">
                    <div class="text-lg font-bold mb-2 text-gray-800">{{ similar.title }}</div>
                    <div class="text-md mb-4 text-gray-700">{{ formatted_content(similar.content) }}</div>
                    <div class="text-sm">{{ moment(String(similar.created_at)).format('LL') }}</div>
                </RouterLink>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { RouterLink, useRoute } from 'vue-router'
    import { ref, onMounted, watch } from 'vue'
    import moment from 'moment'
    import 'moment/dist/locale/fr'

    const route = useRoute()
    const post = ref({})
    const category = ref({})
    const similars = ref({})
    const isLoading = ref(true)

    /**
     * Fonction permettant de supprimer les sauts de ligne d'un texte donné
     * et de le raccourcir s'il est plus long que 150 caractères
     * @param {any} string
     * @returns {any}
     */
     function formatted_content(string) {
        string = string.replace(/<\/?[^>]+>/ig, "")
        if (string.length > 150)
        {
            string = string.substring(0, 150) + "..."
            string = string.substr(0, Math.min(string.length, string.lastIndexOf(' ')))
            string = string + "..."
        }
        return string
    }

    function loadPost()
    {
        axios.get('/api/posts/' + route.params.id)
        .then(response => response.data)
        .then(data => {
            post.value = data.post
            category.value = data.post.category
            similars.value = data.similars

            setTimeout(() => {
                isLoading.value = false
            }, 500)
        })
    }
    
    onMounted(() =>
    {
        loadPost()
    })

    watch(() => route.params.id, () => {
        isLoading.value = true
        loadPost()
    })
</script>