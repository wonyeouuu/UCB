import Vue from 'vue'
import VueRouter from 'vue-router'
import VueResource from 'vue-resource'

//components
import Login from './components/login/Login.vue'
import LoginView from './components/login/LoginView.vue'
import RegisterView from './components/login/RegisterView.vue'

import Home from './components/Home.vue'
import Reminders from './components/reminder/Reminders.vue'
import EditReminder from './components/reminder/EditReminder.vue'
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
            '/reminder': {
                component: Reminders,
                name: 'reminder'
            },
            '/record': {
                component: Reminders,
                name: 'record'
            },
            '/analysis': {
                component: Reminders,
                name: 'analysis'
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
    },
    '/reminder/edit': {
        component: EditReminder,
        name: 'editReminder'
    }
})

router.redirect({
    '/': '/login',
    '/home': '/home/reminder'
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
