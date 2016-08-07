<template lang="jade">
nav
    div.nav-wrapper
        a.brand-logo MS Diary
        ul#slide-out.side-nav
            li
                a.waves-effect Home
            li
                a.waves-effect Privacy Policy
            li
                a.waves-effect Term of use
            li
                a.waves-effect Useful Links
            li
                a.waves-effect Log out
        a.button-collapse(data-activates='slide-out')
            i.material-icons menu
</template>

<script>
export default {
    ready() {
        $(".button-collapse").sideNav({
            // closeOnClick: true
        })
    }
}
</script>

<style lang="stylus" scoped>
</style>
