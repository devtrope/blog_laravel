<template>
    <h1 class="text-5xl font-bold text-slate-800">Nos derniers articles</h1>
    <div  class="animate-pulse">
        <div v-if="isLoading" class="animate-pulse mt-24 grid md:grid-cols-2 xs:grid-cols-1 gap-8">
            <div v-for="i in 6">
                <div class="bg-gray-300 aspect-video rounded-sm"></div>
                <div class="pt-6">
                    <div class="bg-gray-300 w-10 h-5 rounded-full"></div>
                    <div class="my-2 bg-gray-300 rounded-full h-5"></div>
                    <div class="my-2 bg-gray-300 rounded-full h-5 w-1/2"></div>
                    <div class="bg-gray-300 w-12 h-5 rounded-full"></div>
                    <div class="mt-4 bg-gray-300 rounded-full h-5"></div>
                    <div class="mt-1 bg-gray-300 rounded-full h-5"></div>
                    <div class="mt-1 bg-gray-300 rounded-full h-5 w-1/2"></div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="!isLoading" class="mt-24 grid md:grid-cols-2 xs:grid-cols-1 gap-8">
        <div v-for="post in posts" :key="post.id">
            <RouterLink :to="'/post/' + post.id " class="group">
                <img :src="'/storage/' + post.picture" class="w-[100%] aspect-video object-cover shadow-lg rounded-sm group-hover:shadow-xl ease-in-out duration-300">
                <div class="pt-6">
                    <span class="text-sm bg-indigo-100 text-indigo-700 py-1 px-3 rounded-full">{{ post.category.name }}</span>
                    <div class="font-black my-2 text-3xl text-gray-800 leading-tight group-hover:text-blue-500 ease-in-out duration-300">{{ post.title }}</div>
                    <div class="text-sm text-slate-700">{{ moment(String(post.created_at)).format('LL') }}</div>
                    <p class="mt-4 text-slate-800">{{ formatted_content(post.content) }}</p>
                </div>
            </RouterLink>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import moment from 'moment'
    import 'moment/dist/locale/fr'

    const posts = ref()
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

    onMounted(() => {
        axios.get('/api/posts')
        .then(response => response.data)
        .then(data => {
            posts.value = data.posts
            setTimeout(() => {
                isLoading.value = false
            }, 500)
        })
    })
</script>