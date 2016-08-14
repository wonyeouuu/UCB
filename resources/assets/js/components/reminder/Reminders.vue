<template lang="jade">
div.row.reminder-container
    div.col.s12.m6(v-for='reminder in reminders')
        div.card.grey.lighten-2
            div.card-content
                span.card-title {{ reminder.name }}
                p {{ reminder.note }}
            div.card-action
                a {{ reminder.alerts[0].alert_at }}
                //- a(@click='edit(reminder.id)') Edit

a.btn-floating.btn-large.waves-effect.waves-light(@click='$router.go({ name: "editReminder" })')
    i.material-icons add
</template>

<script>
import { fetchReminders } from '../../vuex/actions'
import { reminders } from '../../vuex/getters'
export default {
    vuex: {
        getters: {
            reminders
        },
        actions: {
            refresh: fetchReminders
        }
    },
    ready() {
        this.refresh()
    }
}
</script>

<style lang="stylus" scoped>
.btn-floating
    position fixed
    bottom 1rem
    right 1rem
.reminder-container
    height 78vh
    overflow-y scroll
</style>
