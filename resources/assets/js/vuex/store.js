import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

Vue.use(Vuex)
Vue.use(VueRouter)

const state = {
    reminders: []
}

const mutations = {
    FETCH_REMINDERS(state, reminders) {
        state.reminders = reminders
    }
}

export default new Vuex.Store({
    state,
    mutations
})
