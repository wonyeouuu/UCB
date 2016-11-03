<template lang="jade">
form.col.s12
    div.row
        div.input-field.col.s10.offset-s1
            i.material-icons.prefix account_circle
            input#usernameInput.validate(type='text', v-model='username')
            label(for='usernameInput') Username
            label.error(v-if='error') {{ error.username[0] }}
    div.row
        div.input-field.col.s10.offset-s1
            i.material-icons.prefix fingerprint
            input#passwordInput.validate(type='password', v-model='password')
            label(for='passwordInput') Password
            label.error(v-if='error') {{ error.password[0] }}
    div.row
        a.waves-effect.waves-light.btn.col.s8.offset-s2(@click='login()') Done
</template>

<script>
import { setUser } from '../../vuex/actions'

export default {
    data() {
        return {
            username: "",
            password: "",
            error: {
                username: "",
                password: ""
            }
        }
    },
    vuex: {
        actions: {
            setUser
        }
    },
    methods: {
        login() {
            this.error = {
                username: "",
                password: ""
            }
            this
                .$http
                .post('/login', {
                    username: this.username,
                    password: this.password
                })
                .then(({ data, status }) => {
                    if (data.success == 1) {
                        Materialize.toast(data.msg, 5000)
                        this.setUser(data.user)
                        Android.showToast(data.user.username)
                        this.$router.go({ name: 'home' })
                    }
                })
                .catch(({ data, status }) => {
                    if (status == 422) {
                        this.error = data
                    }
                })
        }
    }
}
</script>

<style lang="stylus" scoped>
.error
    color red
    position relative
    top -1.5rem
    left 0 !important
    font-size 0.6rem !important
</style>
