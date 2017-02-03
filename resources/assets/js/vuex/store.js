import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

Vue.use(Vuex)
Vue.use(VueRouter)

const state = {
    user: null,
    reminders: [],
    records: [],
    durations: {},
}

const mutations = {
    FETCH_REMINDERS(state, reminders) {
        state.reminders = reminders
    },
    FETCH_RECORDS(state, records) {
        state.records = records
    },
    SET_USER(state, user) {
        state.user = user
    },
    SET_DURATION(state, index, duration) {
        state.durations[index] = duration
    }
}

export default new Vuex.Store({
    state,
    mutations
})
