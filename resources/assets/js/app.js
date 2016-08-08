import Vue from 'vue'
import store from './vuex/store'
import router from './router'
import { sync } from 'vuex-router-sync'
import App from './components/App.vue'

import $ from 'jquery'

sync(store, router)


router.start(App, '#app')
