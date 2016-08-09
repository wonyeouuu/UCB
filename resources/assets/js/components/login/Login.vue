<template lang="jade">
div.login-container
    div.row
        div.row
            a.waves-light.waves-effect.btn.col.s4.offset-s2.btn-login(v-link='{ path: "login" }') Login
            a.waves-light.waves-effect.btn.col.s4.btn-register(v-link='{ path: "register" }') Sign Up
        router-view
</template>

<script>
export default {

}
</script>

<style lang="stylus" scoped>
btn-group-radius = 0.2rem
.login-container
    width 100%
    height 100vh
    display flex
    flex-direction column
    justify-content center
    align-items center
    background-color #eee
.row
    width 100%

.btn-login
    border-radius btn-group-radius 0 0 btn-group-radius

.btn-register
    border-radius 0 btn-group-radius btn-group-radius 0

</style>
