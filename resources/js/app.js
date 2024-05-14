import './bootstrap';
import { createApp } from 'vue'
import { createWebHistory, createRouter } from 'vue-router'
import { createStore } from 'vuex'

import App from './App.vue'
import HomeView from './Pages/HomeView.vue'
import AdministrationView from './Pages/Administration/AdministrationView.vue'
import PostEditView from './Pages/Administration/PostEditView.vue';
import PostAddView from './Pages/Administration/PostAddView.vue';
import LoginView from './Pages/Login/LoginView.vue';
import PostView from './Pages/PostView.vue';
import NotFoundView from './Pages/NotFoundView.vue';

const routes = [
    { path: '/', component: HomeView },
    { path: '/admin', component: AdministrationView, meta: { requiresAuth: true } },
    { path: '/admin/post/edit/:id', component: PostEditView, meta: { requiresAuth: true } },
    { path: '/admin/post/create', component: PostAddView, meta: { requiresAuth: true } },
    { path: '/post/:id', component: PostView },
    { path: '/login', component: LoginView },
    { path: '/:pathMatch(.*)', component: NotFoundView },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return { top: 0 }
    }
})

function loggedIn() {
    return (localStorage.getItem('token') != null)
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(rec => rec.meta.requiresAuth) && !loggedIn()) {
        next('/login')
    }
    else
    {
        next()
    }
})

const store = createStore({
    state() {
        return {
            success: null,
            loggedIn: loggedIn()
        }
    },
    mutations: {
        successMessage (state, message) {
            state.success = message
        },
        isLoggedIn(state, bool) {
            state.loggedIn = bool
        }
    }
})

createApp(App).use(router).use(store).mount('#app')