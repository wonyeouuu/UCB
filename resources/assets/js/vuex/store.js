import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

Vue.use(Vuex)
Vue.use(VueRouter)

const state = {
    reminders: [],
    records: []
}

const mutations = {
    FETCH_REMINDERS(state, reminders) {
        state.reminders = reminders
    },
    FETCH_RECORDS(state, records) {
        state.records = records
    }
}

export default new Vuex.Store({
    state,
    mutations
})
