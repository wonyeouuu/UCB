<template lang="jade">
form.col.s12
    div.row
        div.input-field.col.s10.offset-s1
            i.material-icons.prefix account_circle
            input#usernameInput.validate(type='text')
            label(for='usernameInput') Username
    div.row
        div.input-field.col.s10.offset-s1
            i.material-icons.prefix fingerprint
            input#passwordInput.validate(type='password')
            label(for='passwordInput') Password
    div.row
        div.input-field.col.s10.offset-s1
            i.material-icons.prefix fingerprint
            input#passwordInputConfirm.validate(type='password')
            label(for='passwordInputConfirm') Confirm
    div.row
        a.waves-effect.waves-light.btn.col.s8.offset-s2 Done
</template>

<script>
export default {
}
</script>

<style lang="stylus" scoped>
</style>
