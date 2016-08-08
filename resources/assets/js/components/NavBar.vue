<template lang="jade">
nav
    div.nav-wrapper
        a.brand-logo {{ header }}
        ul#slide-out.side-nav
            li
                a.waves-effect(v-link='{ name: "reminder" }') Home
            li
                a.waves-effect(v-link='{ name: "privacyPolicy" }') Privacy Policy
            li
                a.waves-effect(v-link='{ name: "termOfUse" }') Term of use
            li
                a.waves-effect(v-link='{ name: "usefulLink" }') Useful Links
            li
                a.waves-effect(@click='logout()') Log out
        a.button-collapse(data-activates='slide-out')
            i.material-icons menu
</template>

<script>
export default {
    ready() {
        $(".button-collapse").sideNav({
            closeOnClick: true
        })
    },
    computed: {
        header() {
            const switchObj = {
                home: 'MS Diary',
                reminder: 'Reminder',
                record: 'Record',
                analysis: 'Analysis',
                privacyPolicy: 'Privacy Policy',
                termOfUse: 'Term Of Use',
                usefulLink: 'Useful Links'
            }
            return switchObj[this.$route.name]
        }
    },
    methods: {
        logout() {
            this
                .$http
                .get('/logout')
                .then(({ data }) => {
                    if (data.success == 1) {
                        Materialize.toast(data.msg, 5000)
                        this.$router.go({ name: "loginView" })
                    }
                })
        }
    }

}
</script>

<style lang="stylus" scoped>
</style>
