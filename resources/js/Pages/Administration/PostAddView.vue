<template>
    <h1 class="text-2xl font-bold text-slate-700">Modification d'un article</h1>
    <form class="mt-16" @submit.prevent="submit" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-8">
            <div class="flex flex-col gap-8">
                <div>
                    <label class="font-semibold text-sm block mb-2 text-slate-700">Titre</label>
                    <input type="text" id="title" class="border-slate-200 border-solid border w-full py-2 px-3 rounded text-md focus-visible:outline-none focus-visible:border-indigo-400" v-model="form.title" />
                    <p class="text-sm text-red-500" v-if="errors.title" v-text="errors.title[0]"></p>
                </div>
                <div>
                    <label class="font-semibold text-sm block mb-2 text-slate-700">Catégorie</label>
                    <input type="text" id="title" class="border-slate-200 border-solid border w-full py-2 px-3 rounded text-md focus-visible:outline-none focus-visible:border-indigo-400" v-model="form.category" />
                    <p class="text-sm text-red-500" v-if="errors.category" v-text="errors.category[0]"></p>
                </div>
            </div>
            <div>
                <label class="font-semibold text-sm block mb-2 text-slate-700">Image d'illustration</label>
                <input type="file" id="picture" class="border-slate-200 border-solid border w-full py-2 px-3 rounded text-sm" @change="e => uploadFile(e.target.files[0])" accept="image/*" />
                <p class="text-sm text-red-500" v-if="errors.picture" v-text="errors.picture[0]"></p>
            </div>
        </div>
        <div class="mt-8">
            <label class="font-semibold text-sm block mb-2 text-slate-700">Contenu de l'article</label>
            <div v-html="form.content" id="content" contentEditable="true" 
            class="border-slate-200 border-solid border w-full py-2 px-3 rounded h-[500px] overflow-y-scroll text-md focus-visible:outline-none 
            focus-visible:border-indigo-400"></div>
            <p class="text-sm text-red-500" v-if="errors.content" v-text="errors.content[0]"></p>
        </div>
        <button class="bg-green-500 hover:bg-green-600 shadow-md hover:shadow-sm text-sm font-semibold text-white py-3 rounded-md w-fit px-8 ease-in-out duration-300 mt-8">Enregistrer les modifications</button>
    </form>
</template>

<script setup>
    import { useRouter } from 'vue-router'
    import { useStore } from 'vuex'
    import { ref, reactive } from 'vue'

    const router = useRouter()
    const store = useStore()
    const image = ref()
    const errors = ref({})

    /**
     * Permet de télécharger une image
     * @param {any} file
     * @returns {any}
     */
    function uploadFile(file) {
        image.value = file
    }

    const form = reactive(({
        title: '',
        category: '',
        content: ''
    }))

    /**
     * Envoi du formulaire
     * @returns {any}
     */
    function submit() {
        let formData = new FormData()
        formData.append('title', form.title)
        formData.append('category', form.category)
        formData.append('content', content.innerText)
        if (image.value)
            formData.append('picture', image.value)

        axios.post('/api/posts', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        .then(response => response.data)
        .then(data => {
            if (data.success)
            {
                store.commit('successMessage', "L'article a bien été ajouté")
                router.push('/admin')
            }
        })
        .catch(error => 
        {
            errors.value = error.response.data.errors
        })
    }
</script>