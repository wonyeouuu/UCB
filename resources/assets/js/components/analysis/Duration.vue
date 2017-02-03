<template lang="jade">
div
    nav
        div.nav-wrapper
            a(@click='$router.go({ name: "analysis" })')
                i.material-icons keyboard_arrow_left
            a.action-right(@click='create')
                i.material-icons edit
    div.row
        form.col.s12
            ul.collection
                li.collection-item
                    i.material-icons view_week
                    span.title FIRST DURATION
                li.collection-item
                    div.row
                        div.input-field.col.s12
                            input#dateInput.datepicker(type='date', v-model='duration1.from')
                            label(for='dateInput') From
                    div.row
                        div.input-field.col.s12
                            input#dateInput.datepicker(type='date', v-model='duration1.to')
                            label(for='dateInput') To
            ul.collection
                li.collection-item
                    i.material-icons view_week
                    span.title SECOND DURATION
                li.collection-item
                    div.row
                        div.input-field.col.s12
                            input#dateInput.datepicker(type='date', v-model='duration2.from')
                            label(for='dateInput') From
                    div.row
                        div.input-field.col.s12
                            input#dateInput.datepicker(type='date', v-model='duration2.to')
                            label(for='dateInput') To
</template>

<script>
import { setDuration } from '../../vuex/actions'

export default {
    data() {
        return {
            duration1: {},
            duration2: {}
        }
    },
    vuex: {
        actions: {
            setDuration
        }
    },
    ready() {
        const datePickers = $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            format: 'yyyy-mm-dd',
            selectYears: 15 // Creates a dropdown of 15 years to control year
        })
    },
    methods: {
        create() {
            this.setDuration('first', {
                from: this.duration1.from,
                to: this.duration1.to
            })
            this.setDuration('second', {
                from: this.duration2.from,
                to: this.duration2.to
            })
            this.$router.go({ name: 'analysis' })
        }
    }

}
</script>

<style lang="stylus" scoped>
.action-right
    position fixed
    top 0
    right 5px
</style>
