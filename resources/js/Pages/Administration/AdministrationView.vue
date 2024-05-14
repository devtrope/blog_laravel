<template>
    <div class="fixed bottom-0 left-0 right-0 bg-emerald-500 text-white p-4 text-sm z-20 transition-transform ease-in-out duration-500" :class="hideSuccess ? 'translate-y-full' : 'translate-y-0'" v-if="success" v-text="success"></div>
    <div class="md:flex xs:block items-center justify-between">
        <h1 class="text-lg font-bold text-slate-800 md:mb-0 xs:mb-4">Administration</h1>
        <RouterLink to="/admin/post/create" class="bg-gray-800 hover:bg-gray-700 shadow-md hover:shadow-sm text-sm font-semibold text-white py-3 rounded-md px-8 ease-in-out duration-300">Nouvel article</RouterLink>
    </div>
    <div class="bg-white mt-16 rounded-xl border border-solid border-slate-200 animate-pulse h-screen" v-if="isLoading"></div>
    <div class="bg-slate-50 py-8 mt-16 rounded-xl border border-solid border-slate-200" v-if="!isLoading">
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
                    <td class="border-b border-solid border-slate-200 bg-white p-3"><span class="bg-indigo-100 text-indigo-600 rounded-full py-1 px-3 text-xs">{{ post.category.name }}</span></td>
                    <td class="border-b border-solid border-slate-200 bg-white p-3">
                        <div class="flex items-center gap-3">
                            <RouterLink title="Modifier" :to="'/admin/post/edit/' + post.id"><PencilSquareIcon class="size-5 text-gray-600" /></RouterLink>
                            <form @submit.prevent="e => deletePost(e.target.dataset.id)" :data-id="post.id" class="leading-[0px]">
                                <button title="Supprimer"><TrashIcon class="size-5 text-red-500" /></button>
                            </form>
                        </div>
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
    import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/outline'

    const store = useStore()
    const posts = ref()
    const success = ref()
    const isLoading = ref(true)
    const hideSuccess = ref(true)

    /**
     * Charge la liste des articles
     * @returns {any}
     */
    function loadPosts()
    {
        axios.get('/api/posts/')
        .then(response => response.data)
        .then(data => {
            posts.value = data.posts
            
            setTimeout(() => {
                isLoading.value = false
            }, 500)

            hideSuccess.value = false
            setTimeout(() => {
                hideSuccess.value = true
            }, 3000)
        })
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
            isLoading.value = true

            axios.post('/api/posts/' + post_id, {
                _method: 'delete'
            })
            .then(() => {    
                //On recharge les articles
                loadPosts()

                success.value = "L'article a bien été supprimé"

                hideSuccess.value = false
                setTimeout(() => {
                    hideSuccess.value = true
                }, 3000)
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