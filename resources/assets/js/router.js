import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

//components
import Login from './components/login/Login.vue'
import LoginView from './components/login/LoginView.vue'
import RegisterView from './components/login/RegisterView.vue'

import Home from './components/Home.vue'
import Reminders from './components/reminder/Reminders.vue'
import PrivacyPolicy from './components/home/PrivacyPolicy.vue'
import TermOfUse from './components/home/TermOfUse.vue'
import UsefulLink from './components/home/UsefulLink.vue'

Vue.use(VueRouter)
Vue.use(VueResource)

const router = new VueRouter()

router.map({
    '/': {
        name: 'login',
        component: Login,
        subRoutes: {
            'login': {
                component: LoginView,
                name: 'loginView'
            },
            'register': {
                component: RegisterView,
                name: 'registerView'
            }
        }
    },
    '/home': {
        name: 'home',
        component: Home,
        subRoutes: {
            '/': {
                component: Reminders,
                name: 'reminder'
            },
            '/privacyPolicy': {
                component: PrivacyPolicy,
                name: 'privacyPolicy'
            },
            '/termOfUse': {
                component: TermOfUse,
                name: 'termOfUse'
            },
            '/usefulLink': {
                component: UsefulLink,
                name: 'usefulLink'
            },
        }
    }
})

router.redirect({
    '/': '/login'
})

router.beforeEach(function(transition) {
    if (['/', '/login'].indexOf(transition.to.path) != -1) {
        Vue.http.get('/checkLogin').then(({ data }) => {
            if (data == 1) {
                router.go({ name: 'home' })
            }
        })
    }
    transition.next()
})

export default router
