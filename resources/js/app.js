import './bootstrap';
import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import { createStore } from 'vuex'

import App from './App.vue'
import HomeView from './Pages/HomeView.vue'
import AdministrationView from './Pages/Administration/AdministrationView.vue'
import PostEditView from './Pages/Administration/PostEditView.vue';
import PostAddView from './Pages/Administration/PostAddView.vue';
import NotFoundView from './Pages/NotFoundView.vue';
import PostView from './Pages/PostView.vue';

const routes = [
    { path: '/', component: HomeView },
    { path: '/admin', component: AdministrationView },
    { path: '/admin/post/edit/:id', component: PostEditView },
    { path: '/admin/post/create', component: PostAddView },
    { path: '/post/:id', component: PostView },
    { path: '/:pathMatch(.*)', component: NotFoundView },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

const store = createStore({
    state() {
        return {
            success: null
        }
    },
    mutations: {
        successMessage (state, message) {
            state.success = message
        }
    }
})

createApp(App).use(router).use(store).mount('#app')