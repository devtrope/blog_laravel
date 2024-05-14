<template>
    <div class="w-full bg-emerald-500 text-white mb-4 p-4 rounded-md text-sm" v-if="success" v-text="success"></div>
    <div class="lg:flex sm:block items-center justify-between">
        <h1 class="text-lg font-bold text-slate-800">Administration</h1>
        <RouterLink to="/admin/post/create">Nouvel article</RouterLink>
    </div>
    <div class="bg-slate-50 py-8 mt-16 rounded-xl border border-solid border-slate-200">
        <table class="table-auto border-collapse w-full text-sm">
            <thead>
                <tr class="text-slate-400">
                    <th class="border-b border-solid border-slate-200 p-3 bg-slate-50 font-medium text-center">Id</th>
                    <th class="border-b border-solid border-slate-200 text-left p-3 bg-slate-50 font-medium w-[100px]">Image</th>
                    <th class="border-b border-solid border-slate-200 text-left p-3 bg-slate-50 font-medium">Titre</th>
                    <th class="border-b border-solid border-slate-200 text-left p-3 bg-slate-50 font-medium">Catégorie</th>
                    <th class="border-b border-solid border-slate-200 text-left p-3 bg-slate-50 font-medium"></th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <tr v-for="post in posts">
                    <td class="border-b border-solid border-slate-200 bg-white p-3 text-center">{{ post.id }}</td>
                    <td class="border-b border-solid border-slate-200 bg-white p-3"><img :src="'/storage/' + post.picture" class="w-[100px] aspect-video rounded-sm object-cover"></td>
                    <td class="border-b border-solid border-slate-200 bg-white p-3">{{ post.title }}</td>
                    <td class="border-b border-solid border-slate-200 bg-white p-3 text-indigo-700 font-semibold">{{ post.category }}</td>
                    <td class="border-b border-solid border-slate-200 bg-white p-3 flex flex-col gap-2">
                        <RouterLink :to="'/admin/post/edit/' + post.id" class="bg-indigo-700 flex justify-center items-center p-2 text-white text-xs rounded-sm">Modifier</RouterLink>
                        <form @submit.prevent="e => deletePost(e.target.dataset.id)" :data-id="post.id">
                            <button class="bg-red-600 flex w-full justify-center items-center p-2 text-white text-xs rounded-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
    import { RouterLink } from 'vue-router'
    import { useStore } from 'vuex'
    import { ref, onMounted } from 'vue'

    const store = useStore()
    const posts = ref()
    const success = ref()

    /**
     * Charge la liste des articles
     * @returns {any}
     */
    function loadPosts()
    {
        axios.get('/api/posts/')
        .then(response => response.data)
        .then(data => posts.value = data.posts)
    }


    /**
     * Supprime un article et recharge la liste
     * @param {any} post_id
     * @returns {any}
     */
    function deletePost(post_id)
    {
        if (confirm("Confirmer la suppression de l'article ?"))
        {
            axios.post('/api/posts/' + post_id, {
                _method: 'delete'
            })
            .then(() => {
                success.value = "L'article a bien été supprimé"
    
                //On recharge les articles
                loadPosts()
            })
        }
    }

    onMounted(() => {
        loadPosts()

        if (store.state.success)
        {
            success.value = store.state.success
            store.commit('successMessage', null)
        }
    })
</script>