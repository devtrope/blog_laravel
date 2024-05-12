import './bootstrap';
import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'

import HomeView from './Pages/HomeView.vue'
import AdministrationView from './Pages/AdministrationView.vue'
import App from './Pages/App.vue'
import NotFoundView from './Pages/NotFoundView.vue';
import PostView from './Pages/PostView.vue';

const routes = [
    { path: '/', component: HomeView },
    { path: '/administration', component: AdministrationView },
    { path: '/post/:id', component: PostView },
    { path: '/:pathMatch(.*)', component: NotFoundView },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

createApp(App).use(router).mount('#app')