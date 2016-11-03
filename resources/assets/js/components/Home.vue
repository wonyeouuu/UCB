<template lang="jade">
div
    nav-bar
    tabs(v-if='["reminder", "record", "analysis"].indexOf($route.name) != -1')
    router-view
</template>

<script>
import NavBar from './NavBar.vue'
import Tabs from './Tabs.vue'
import { user } from '../vuex/getters'

export default {
    components: { NavBar, Tabs },
    vuex: {
        getters: {
            user
        }
    },
    ready() {
        if (typeof Android !== 'undefined' && this.user) {
            Android.showToast(this.user.id)
        }
    }
}
</script>

<style lang="stylus" scoped>
</style>
