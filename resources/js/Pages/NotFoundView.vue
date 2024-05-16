<template>
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-9xl font-black mb-4 text-gray-800">404</h1>
            <h2 class="text-lg font-medium mb-8">La page demandée n'existe pas</h2>
            <RouterLink to="/" class="bg-gray-900 text-white text-md font-bold py-3 rounded-md px-8">Revenir à l'accueil</RouterLink>
        </div>
    </div>
</template>

<script setup>
    import { RouterLink } from 'vue-router'
</script>