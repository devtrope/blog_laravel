<template>
    <h1>A propos</h1>
</template>

<script setup>
    import { onMounted } from 'vue'

    onMounted(() => {
        axios.get('/api/test')
        .then(response => console.log(response))
    })
</script>