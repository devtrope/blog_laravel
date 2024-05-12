import './bootstrap';
import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'

import HomeView from './Pages/HomeView.vue'
import AboutView from './Pages/AboutView.vue'
import App from './Pages/App.vue'
import NotFoundView from './Pages/NotFoundView.vue';
import PostView from './Pages/PostView.vue';

const routes = [
    { path: '/', component: HomeView },
    { path: '/about', component: AboutView },
    { path: '/post/:id', component: PostView },
    { path: '/:pathMatch(.*)', component: NotFoundView },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App).use(router).mount('#app')