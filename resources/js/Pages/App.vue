<template>
    <nav class="fixed top-0 left-0 right-0 bg-white border-b border-solid border-slate-300 z-10">
        <div class="lg:w-7/12 mx-auto py-4 flex justify-between items-center sm:w-11/12">
            <RouterLink to="/">Mon blog</RouterLink>
            <RouterLink to="/administration">Administration</RouterLink>
        </div>
    </nav>
    <main class="lg:w-7/12 mx-auto pt-24 py-8 sm:w-11/12 min-h-full">
        <RouterView />
    </main>
</template>