<template>
    <nav class="fixed top-0 left-0 right-0 bg-gray-900 border-b border-solid border-gray-700 z-10">
        <div class="3xl:w-7/12 xl:w-9/12 md:10/12 xs:w-11/12 mx-auto py-6 flex justify-between items-center">
            <RouterLink to="/" class="text-2xl font-bold text-white">Blog</RouterLink>
            <div v-if="store.state.user" class="flex gap-4">
                <RouterLink to="/admin" class="bg-white text-gray-900 text-md font-bold py-3 rounded-md px-8">Administration</RouterLink>
                <button @click="logout" class="bg-transparent border border-solid border-white text-white text-md font-bold py-3 rounded-md px-8">Déconnexion</button>
            </div>
            <div v-if="!store.state.user">
                <RouterLink to="/login" class="bg-white text-gray-900 text-md font-bold py-3 rounded-md px-8">Connexion</RouterLink>
            </div>
        </div>
    </nav>
    <main class="3xl:w-7/12 xl:w-9/12 md:10/12 xs:w-11/12 mx-auto pt-40 py-8 min-h-full">
        <RouterView />
    </main>
    <footer class="bg-gray-900 py-3">
        <div class="3xl:w-7/12 xl:w-9/12 md:10/12 xs:w-11/12 mx-auto text-white text-xs flex justify-center font-bold">
            Par Quentin SCHIFFERLE
        </div>
    </footer>
</template>

<script setup>
    import { useStore } from 'vuex'

    const store = useStore()
    
    function logout() {
        axios.post('/api/logout')
        .then(() => store.commit('clearUserData'))
    }

    //On vérifie si l'utilisateur est connecté au rechargement d'une page
    const userInfo = localStorage.getItem('user')
    if (userInfo)
        store.commit('setUserData', JSON.parse(userInfo))
</script>