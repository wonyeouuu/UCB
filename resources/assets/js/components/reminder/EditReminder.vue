<template lang="jade">
div
    nav
        div.nav-wrapper
            a.brand-logo Reminder
            a(@click='$router.go({ name: "reminder" })')
                i.material-icons keyboard_arrow_left
            a.action-right(@click='create', v-if='!$route.params.id')
                i.material-icons edit
            a.action-right(@click='update', v-if='$route.params.id')
                i.material-icons edit
    div#reminder-form-container.row
        form.col.s12
            ul.collection
                li.collection-item
                    i.material-icons tab
                    span.title Information
                li.collection-item
                    div.row
                        div.input-field.col.s12
                            input#nameInput.validate(type='text', v-model='name')
                            label(for='nameInput') Medicine Name
                    div.row
                        div.input-field.col.s12
                            input#startDateInput.datepicker(type='date', v-model='startDate')
                            label(for='startDateInput') Start Date
                    div.row
                        div.input-field.col.s12
                            input#endDateInput.datepicker(type='date', v-model='endDate')
                            label(for='endDateInput') End Date
                li.collection-item
                    i.material-icons timer
                    span.title Frequency
                li.collection-item
                    div.row
                        div.input-field.col.s12
                            select#frequency-select
                                option(:value='0', disabled) Choose one
                                option(v-for='option in frequencyOptions', :value='option.value') {{ option.text }}
                    div.row
                        div.input-field.col.s12(v-show='showThreeDay')
                            select#three-day-select(multiple, v-model='threeDays')
                                option(:value='', disabled, selected) Choose 3 days
                                option(v-for='day in weekDays', :value='day.value') {{ day.text }}
                            label Choose 3 days
                            label.error(v-if='errors.threeDays') Please choose 3 days
                    div.row
                        div.input-field.col.s12(v-show='showOneDay')
                            select#one-day-select(v-model='oneDay')
                                option(:value='', disabled, selected) Choose a day
                                option(v-for='day in weekDays', :value='day.value') {{ day.text }}
                            label Choose a day
                    div.row(v-show='timeCounter[0]')
                        div.input-field.col.s12
                            label(for='timepicker1') Time
                            input#timepicker1.timepicker(type='time', v-model='time[0]')
                    div.row(v-show='timeCounter[1]')
                        div.input-field.col.s12
                            label(for='timepicker2') Time
                            input#timepicker2.timepicker(type='time', v-model='time[1]')
                    div.row(v-show='timeCounter[2]')
                        div.input-field.col.s12
                            label(for='timepicker3') Time
                            input#timepicker3.timepicker(type='time', v-model='time[2]')
                    div.row(v-show='timeCounter[3]')
                        div.input-field.col.s12
                            label(for='timepicker4') Time
                            input#timepicker4.timepicker(type='time', v-model='time[3]')
                li.collection-item
                    i.material-icons add_alert
                    span.title Reminder
                li.collection-item
                    div.row
                        div.input-field.col.s12
                            select#reminder-before-select
                                option(:value='', disabled) Choose one
                                option(v-for='item in reminderBefore', :value='item.value') {{ item.text }}
                    div.row
                        div.input-field.col.s12
                            textarea#note-textarea.materialize-textarea(length='120', v-model='note')
                            label(for='note-textarea') Note
        ul.collection(v-if='alerts.length > 0')
            li.collection-item(v-for='alert in alerts')
                |{{ alert.alert_at }}
                span.float-right.status-skip(v-if='alert.status == 1') skip
                span.float-right.status-finished(v-if='alert.status == 2') finished
        button.btn.waves-effect.waves-light.delete-btn(@click='delete', v-if='$route.params.id') Delete
</template>

<script>
import moment from 'moment'
import { frequency, weekDays, reminderBefore } from '../../options'
import { fetchReminders } from '../../vuex/actions'
export default {
    vuex: {
        actions: {
            fetchReminders
        }
    },
    data() {
        return {
            name: "",
            startDate: "",
            endDate: "",
            frequency: "",
            reminder: "",
            oneDay: "",
            threeDays: [],
            time: [],
            note: "",
            error: {},
            frequencyOptions: frequency,
            weekDays,
            alerts: [],
            reminderBefore
        }
    },
    computed: {
        showThreeDay() {
            return this.frequency == 5
        },
        showOneDay() {
            return this.frequency == 8
        },
        timeCounter() {
            const switchObj = {
                1: [true, false, false, false],
                2: [true, true, false, false],
                3: [true, true, true, false],
                4: [true, true, true, true],
                5: [true, false, false, false],
                6: [true, false, false, false],
                7: [true, false, false, false],
                8: [true, false, false, false],
                9: [true, false, false, false]
            }
            if (this.frequency == "") {
                return [false, false, false, false]
            }
            return switchObj[this.frequency]
        },
        errors() {
            return {
                threeDays: this.threeDays.length != 3
            }
        }
    },
    ready() {
        const datePickers = $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            format: 'yyyy-mm-dd',
            selectYears: 15 // Creates a dropdown of 15 years to control year
        })
        $('select').material_select()
        $('textarea#note-textarea').characterCounter();
        if (this.$route.params.id) {
            this.$http.get(`/reminder/${this.$route.params.id}`).then(({ data }) => {
                this.name = data.name
                this.startDate = moment(data.start_at).format('YYYY-MM-DD')
                this.endDate = moment(data.end_at).format('YYYY-MM-DD')
                this.frequency = data.frequency
                this.reminder = data.reminder_before
                if (data.days) {
                    this.oneDay = data.days[0]
                    this.threeDays = data.days
                }
                this.time = data.times
                this.note = data.note
                $('#nameInput').val(data.name)
                $('#frequency-select').val(data.frequency)
                $('#reminder-before-select').val(data.reminder_before)
                Materialize.updateTextFields()
                $('label[for="startDateInput"]').addClass('active')
                $('label[for="endDateInput"]').addClass('active')
                $('label[for="timepicker1"]').addClass('active')
                $('label[for="timepicker2"]').addClass('active')
                $('label[for="timepicker3"]').addClass('active')
                $('label[for="timepicker4"]').addClass('active')
                $('label[for="note-textarea"]').addClass('active')
                this.alerts = data.alerts
            })
        }
        $('#timepicker1').pickatime({
            autoclose: true,
            twelvehour: false
        })
        $('#timepicker2').pickatime({
            autoclose: true,
            twelvehour: false
        })
        $('#timepicker3').pickatime({
            autoclose: true,
            twelvehour: false
        })
        $('#timepicker4').pickatime({
            autoclose: true,
            twelvehour: false
        })
        //used for select
        const vm = this
        $('#frequency-select').on('change', function() {
            vm.updateFrequency($(this).val())
        })
        $('#three-day-select').on('change', function() {
            vm.updateThreeDay($(this).val())
        })
        $('#one-day-select').on('change', function() {
            vm.updateOneDay($(this).val())
        })
        $('#reminder-before-select').on('change', function() {
            vm.updateReminderBefore($(this).val())
        })
    },
    methods: {
        updateFrequency(newStatus) {
            this.frequency = newStatus
        },
        updateThreeDay(newStatus) {
            this.threeDays = newStatus
        },
        updateOneDay(newStatus) {
            this.oneDay = newStatus
        },
        updateReminderBefore(newStatus) {
            this.reminder = newStatus
        },
        create() {
            const switchTimeObj = {
                1: [this.time[0]],
                2: [this.time[0], this.time[1]],
                3: [this.time[0], this.time[1], this.time[2]],
                4: [this.time[0], this.time[1], this.time[2], this.time[3]],
                5: [this.time[0]],
                6: [this.time[0]],
                7: [this.time[0]],
                8: [this.time[0]],
                9: [this.time[0]]
            }
            this.$http.post('/reminder/create', {
                name: this.name,
                start_at: this.startDate,
                end_at: this.endDate,
                frequency: this.frequency,
                days: this.frequency == 5 ? this.threeDays : (this.frequency == 8 ? this.oneDay : null),
                times: switchTimeObj[this.frequency],
                reminder_before: this.reminder,
                note: this.note
            }).then(({ data }) => {
                if (data.success) {
                    Materialize.toast(data.message, 2000)
                    this.$router.go({ name: 'reminder' })
                } else {
                    Materialize.toast(data.message, 2000)
                }
            })
        },
        update() {
            const switchTimeObj = {
                1: [this.time[0]],
                2: [this.time[0], this.time[1]],
                3: [this.time[0], this.time[1], this.time[2]],
                4: [this.time[0], this.time[1], this.time[2], this.time[3]],
                5: [this.time[0]],
                6: [this.time[0]],
                7: [this.time[0]],
                8: [this.time[0]],
                9: [this.time[0]]
            }
            this.$http.post(`/reminder/${this.$route.params.id}`, {
                _method: 'PUT',
                name: this.name,
                start_at: this.startDate,
                end_at: this.endDate,
                frequency: this.frequency,
                days: this.frequency == 5 ? this.threeDays : (this.frequency == 8 ? this.oneDay : null),
                times: switchTimeObj[this.frequency],
                reminder_before: this.reminder,
                note: this.note
            }).then(({ data }) => {
                Materialize.toast(data.message, 2000)
                if (data.success) {
                    this.$router.go({ name: 'reminder' })
                }
            })
        },
        delete() {
            this.$http.post(`/reminder/${this.$route.params.id}`, {
                _method: 'DELETE'
            }).then(({ data }) => {
                Materialize.toast(data.message, 2000)
                if (data.success) {
                    this.$router.go({ name: 'reminder' })
                }
            })
        }
    }
}
</script>

<style lang="stylus" scoped>
div.row
    margin-bottom 0 !important
.action-right
    position fixed
    top 0
    right 5px
#reminder-form-container
    height 88vh
    overflow-y scroll
.collapsible-header
    font-weight bold
span.title
    position relative
    bottom 0.4rem
    left 0.5rem
    font-weight bold
.error
    color red
    position relative
    top -1.5rem
    left 0 !important
    font-size 0.6rem !important
.delete-btn
    width 100%
    background-color red
.float-right
    float right
.status-skip
    color red
.status-finished
    color #50e38e
</style>
