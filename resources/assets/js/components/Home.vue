<template lang="jade">
div
    nav-bar
    tabs(v-if='["reminder", "record", "analysis"].indexOf($route.name) != -1')
    router-view
</template>

<script>
import NavBar from './NavBar.vue'
import Tabs from './Tabs.vue'
export default {
    components: { NavBar, Tabs }
}
</script>

<style lang="stylus" scoped>
</style>
