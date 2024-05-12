<template>
    <div class="lg:flex sm:block items-center justify-between">
        <h1 class="text-lg font-bold text-slate-800">Administration</h1>
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
                    <td class="border-b border-solid border-slate-200 bg-white p-3">
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue'

    const posts = ref()

    onMounted(() => {
        axios.get('/api/admin')
        .then(response => response.data)
        .then(data => posts.value = data.posts)
    })
</script>