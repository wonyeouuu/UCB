import Vue from 'vue'
import VueRouter from 'vue-router'

//components
import Login from './components/login/Login.vue'
import LoginView from './components/login/LoginView.vue'
import RegisterView from './components/login/RegisterView.vue'

import Home from './components/Home.vue'
import Reminders from './components/reminder/Reminders.vue'

Vue.use(VueRouter)

const router = new VueRouter()

router.map({
    '/': {
        name: 'login',
        component: Login,
        subRoutes: {
            'login': {
                component: LoginView
            },
            'register': {
                component: RegisterView
            }
        }
    },
    '/home': {
        name: 'home',
        component: Home,
        subRoutes: {
            '/': {
                component: Reminders
            }
        }
    }
})

export default router
