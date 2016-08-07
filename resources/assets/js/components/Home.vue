<template lang="jade">
nav-bar
tabs
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
