<template>
    <div class="w-1/3 m-auto px-8 py-12 mt-32 rounded-md shadow-md min-h-[100%]">
        <h1 class="font-bold text-2xl text-gray-800">Connexion</h1>
        <form @submit.prevent="login()">
            <div class="mt-8">
                <label class="font-semibold text-sm block mb-1 text-slate-700">Adresse mail</label>
                <input type="email" class="border-slate-200 border-solid border w-full py-2 px-3 rounded-sm text-md focus-visible:outline-none focus-visible:border-indigo-400" v-model="form.email" />
                <p class="text-sm text-red-500" v-if="errors.email" v-text="errors.email[0]"></p>
            </div>
            <div class="mt-8">
                <label class="font-semibold text-sm block mb-1 text-slate-700">Mot de passe</label>
                <input type="password" class="border-slate-200 border-solid border w-full py-2 px-3 rounded-sm text-md focus-visible:outline-none focus-visible:border-indigo-400" v-model="form.password" />
                <p class="text-sm text-red-500" v-if="errors.password" v-text="errors.password[0]"></p>
            </div>
            <button class="bg-green-500 hover:bg-green-600 shadow-md hover:shadow-sm text-sm font-semibold text-white py-4 rounded-md w-full px-8 ease-in-out duration-300 mt-8">Me connecter</button>
        </form>
        <div class="bg-red-500 mt-8 text-white p-4 text-xs text-center rounded-sm" v-if="errors.user" v-text="errors.user[0]"></div>
        <div class="mt-8">
            <div class="text-center text-sm">
                <p>Vous n'avez pas encore de compte</p>
                <RouterLink to="/register" class="text-blue-500 hover:underline">Inscrivez-vous</RouterLink>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { RouterLink, useRouter } from 'vue-router'
    import { reactive, ref } from 'vue'
    import { useStore } from 'vuex'

    const router = useRouter()
    const errors = ref({})
    const store = useStore()

    const form = reactive(({
        email: '',
        password: ''
    }))

    function login() {
        axios.post('/api/login', form)
        .then(response => {
            store.commit('setUserData', response.data)
            router.push('/admin')
        })
        .catch(error => 
        {
            errors.value = error.response.data.errors
        })
    }
</script>