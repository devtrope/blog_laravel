<template>
    <h1 class="text-5xl font-bold text-slate-800">Nos derniers articles</h1>
    <div class="mt-24 grid lg:grid-cols-2 sm:grid-cols-1 md:grid-cols-2 gap-8">
        <div v-for="post in posts" :key="post.id">
            <RouterLink :to="'/post/' + post.id " class="group">
                <img :src="'/storage/' + post.picture" class="w-[100%] lg:h-72 md:h-64 sm:h-80 object-cover shadow-lg rounded-sm group-hover:shadow-xl ease-in-out duration-300">
                <div class="py-6">
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
        .then(data => posts.value = data.posts)
    })
</script>