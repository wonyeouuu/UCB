<template lang="jade">
div
    nav
        div.nav-wrapper
            a.brand-logo Reminder
            a(@click='$router.go({ name: "reminder" })')
                i.material-icons keyboard_arrow_left
            a.action-right
                i.material-icons edit
    div#reminder-form-container.row
        form.col.s12
            ul.collection
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
                    div.row
                        div.input-field.col.s12
                            select#frequency-select
                                option(:value='0', disabled, selected) Choose one
                                option(v-for='option in frequencyOptions', :value='option.value') {{ option.text }}
                    div.row
                        div.input-field.col.s12(v-show='showThreeDay')
                            select#three-day-select(multiple, v-model='threeDays')
                                option(:value='', disabled, selected) Choose 3 days
                                option(v-for='day in weekDays', :value='day.value') {{ day.text }}
                            label Choose 3 days
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
                    div.row
                        div.input-field.col.s12
                            select#reminder-before-select
                                option(:value='', disabled, selected) Choose one
                                option(v-for='item in reminderBefore', :value='item.value') {{ item.text }}
                    div.row
                        div.input-field.col.s12
                            textarea#note-textarea.materialize-textarea(length='120')
                            label(for='note-textarea') Note
</template>

<script>
import { frequency, weekDays, reminderBefore } from '../../options'
export default {
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
            frequencyOptions: frequency,
            weekDays,
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
        }
    },
    ready() {
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            format: 'yyyy-mm-dd',
            selectYears: 15 // Creates a dropdown of 15 years to control year
        })
        $('select').material_select()
        $('textarea#note-textarea').characterCounter();
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
    right 0
#reminder-form-container
    height 88vh
    overflow-y scroll
.collapsible-header
    font-weight bold
</style>
