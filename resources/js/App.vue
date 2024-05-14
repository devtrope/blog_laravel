<template>
    <nav class="fixed top-0 left-0 right-0 bg-gray-900 border-b border-solid border-gray-700 z-10">
        <div class="lg:w-7/12 mx-auto py-6 flex justify-between items-center sm:w-11/12">
            <RouterLink to="/" class="text-2xl font-bold text-white">Blog</RouterLink>
            <RouterLink to="/admin" class="bg-white text-gray-900 text-md font-bold py-3 rounded-md px-8">Administration</RouterLink>
        </div>
    </nav>
    <main class="lg:w-7/12 mx-auto pt-40 py-8 sm:w-11/12 min-h-full">
        <RouterView />
    </main>
</template>