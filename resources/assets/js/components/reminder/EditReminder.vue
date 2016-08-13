<template lang="jade">
div
    nav
        div.nav-wrapper
            a.brand-logo Reminder
            a(@click='$router.go({ name: "reminder" })')
                i.material-icons keyboard_arrow_left
            a.action-right
                i.material-icons edit
    div.row
        form.col.s12
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
            div.row
                div.input-field.col.s12
                    select.browser-default(v-model='frequency')
                        option(:value='0', disabled, selected) Frequency
                        option(:value='1') Every day(1)
                        option(:value='2') 2 times a day(2)
                        option(:value='3') 3 times a day(3)
                        option(:value='4') 4 times a day(4)
                        option(:value='5') 3 times a week(1)
                        option(:value='6') Every 2 days(1)
                        option(:value='7') Every 3 days(1)
                        option(:value='8') Every week(1)
                        option(:value='9') Every 28 days(1)
                div.input-field.col.s12(v-show='showMultiple')
                    select.browser-default(multiple, v-model='threeDays')
                        option(:value='', disabled, selected) Choose 3 days
                        option(:value='1') Monday
                        option(:value='2') Tuesday
                        option(:value='3') Wednesday
                        option(:value='4') Thursday
                        option(:value='5') Friday
                        option(:value='6') Saturday
                        option(:value='7') Sunday



</template>

<script>
export default {
    data() {
        return {
            name: "",
            startDate: "",
            endDate: "",
            frequency: "",
            threeDays: []
        }
    },
    computed: {
        showMultiple() {
            return this.frequency == 5
        }
    },
    ready() {
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15 // Creates a dropdown of 15 years to control year
        })
        $('select').material_select()
    }
}
</script>

<style lang="stylus" scoped>
.action-right
    position fixed
    top 0
    right 0
</style>
