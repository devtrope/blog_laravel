<template>
    <h1 class="text-2xl font-bold text-slate-700">Modification d'un article</h1>
    <form class="mt-16" @submit.prevent="submit" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-8">
            <div class="flex flex-col gap-8">
                <div>
                    <label class="font-semibold text-sm block mb-2 text-slate-700">Titre</label>
                    <input type="text" id="title" class="border-slate-200 border-solid border w-full py-2 px-3 rounded text-md focus-visible:outline-none focus-visible:border-indigo-400" v-model="post.title" />
                    <p class="text-sm text-red-500" v-if="errors.title" v-text="errors.title[0]"></p>
                </div>
                <div>
                    <label class="font-semibold text-sm block mb-2 text-slate-700">Catégorie</label>
                    <input type="text" id="title" class="border-slate-200 border-solid border w-full py-2 px-3 rounded text-md focus-visible:outline-none focus-visible:border-indigo-400" v-model="post.category" />
                    <p class="text-sm text-red-500" v-if="errors.category" v-text="errors.category[0]"></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-sm block mb-2 text-slate-700">Image d'illustration</label>
                <p class="text-xs mb-2 text-slate-700">Cliquez sur l'image pour la modifier</p>
                <img id="preview" :src="'/storage/' + post.picture" class="w-[100%] aspect-video object-cover cursor-pointer border border-solid border-slate-200" @click="() => handlePicture()">
                <input type="file" id="picture" class="hidden" @change="e => uploadFile(e.target.files[0])" accept="image/*" />
                <p class="text-sm text-red-500" v-if="errors.picture" v-text="errors.picture[0]"></p>
            </div>
        </div>
        <div>
            <label class="font-semibold text-sm block mb-2 text-slate-700">Contenu de l'article</label>
            <div v-html="post.content" id="content" contentEditable="true" 
            class="border-slate-200 border-solid border w-full py-2 px-3 rounded h-[500px] overflow-y-scroll text-md focus-visible:outline-none 
            focus-visible:border-indigo-400"></div>
            <p class="text-sm text-red-500" v-if="errors.content" v-text="errors.content[0]"></p>
        </div>
        <button class="bg-green-500 hover:bg-green-600 shadow-md hover:shadow-sm text-sm font-semibold text-white py-3 rounded-md w-fit px-8 ease-in-out duration-300 mt-8">Enregistrer les modifications</button>
    </form>
</template>

<script setup>
    import { useRoute, useRouter } from 'vue-router'
    import { useStore } from 'vuex'
    import { ref, onMounted } from 'vue'

    const route = useRoute()
    const router = useRouter()
    const store = useStore()
    const post = ref({})
    const image = ref()
    const errors = ref({})

    /**
     * Trigger le champ de type file
     * @returns {any}
     */
    function handlePicture() {
        picture.click()
    }

    /**
     * Permet de télécharger une image tout en la prévisualisant
     * @param {any} file
     * @returns {any}
     */
    function uploadFile(file) {
        image.value = file
        preview.src = URL.createObjectURL(file)
    }

    /**
     * Envoi du formulaire
     * @returns {any}
     */
    function submit() {
        let formData = new FormData()
        formData.append('_method', 'put')
        formData.append('title', post.value.title)
        formData.append('category', post.value.category)
        formData.append('content', content.innerText)
        if (image.value)
            formData.append('picture', image.value)

        axios.post('/api/posts/' + route.params.id, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => response.data)
        .then(data => {
            if (data.success)
            {
                store.commit('successMessage', "L'article a bien été mis à jour")
                router.push('/admin')
            }
        })
        .catch(error => 
        {
            errors.value = error.response.data.errors
        })
    }

    onMounted(() => {
        axios.get('/api/posts/' + route.params.id)
        .then(response => response.data)
        .then(data => post.value = data.post)
    })
</script>