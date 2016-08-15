<template lang="jade">
div
    nav
        div.nav-wrapper
            a.brand-logo Record
            a(@click='$router.go({ name: "record" })')
                i.material-icons keyboard_arrow_left
            a.action-right(@click='create()')
                i.material-icons edit
    div#record-form-container.row
        form.col.s12
            div.row
                div.input-field.col.s12
                    input#dateInput.datepicker(type='date', v-model='date')
                    label(for='dateInput') Date
            div.row
                div.input-field.col.s12
                    select#symptom-select
                        option(:value='0', selected) None
                        option(v-for='option in symptoms', :value='option.value') {{ option.text }}
                    label Clinical Symptoms
            div.row
                div.input-field.col.s12
                    div.switch
                        label
                            |Relapse
                            input(type='checkbox', v-model='relapse')
                            span.lever
            div.row
                div.input-field.col.s12
                    select#edss-select
                        option(:value='0', selected) None
                        option(v-for='count in 19', :value='(count + 1) / 2') {{ (count + 1) / 2 }}
                    label EDSS
            div.row
                div.input-field.col.s12
                    select#MRI-select(multiple, v-model='MRI')
                        option(:value='0', selected, disabled) None
                        option(v-for='item in MRIoptions', :value='item.value') {{ item.text }}
                    label MRI
            div.row
                div.input-field.col.s12
                    input#T25FW-input(type='number', v-model='T25FW')
                    label T25FW(seconds)
            div.row
                div.input-field.col.s12
                    select#MSWS12-select
                        option(:value='0', selected) None
                        option(v-for='count in 49', :value='(count + 12)') {{ (count + 12) }}
                    label MSWS12
</template>

<script>
import { symptoms, MRI } from '../../options'
// import moment from 'moment'
export default {
    data() {
        return {
            name: "",
            // date: moment().format('YYYY-MM-DD'),
            date: "",
            symptom: 0,
            relapse: false,
            edss: 0,
            MRI: [0],
            T25FW: "",
            MSWS12: 0,
            symptoms,
            MRIoptions: MRI
        }
    },
    ready() {
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            format: 'yyyy-mm-dd',
            selectYears: 15 // Creates a dropdown of 15 years to control year
        })
        // $('.datepicker').val(moment().format('YYYY-MM-DD'))
        $('select').material_select()
        const vm = this
        $('#symptom-select').on('change', function() {
            vm.updateSymptom($(this).val())
        })
        $('#edss-select').on('change', function() {
            vm.updateEdss($(this).val())
        })
        $('#MRI-select').on('change', function() {
            vm.updateMRI($(this).val())
        })
        $('#MSWS12-select').on('change', function() {
            vm.updateMSWS($(this).val())
        })
    },
    methods: {
        updateSymptom(newStatus) {
            this.symptom = newStatus
        },
        updateEdss(newStatus) {
            this.edss = newStatus
        },
        updateMRI(newStatus) {
            this.MRI = newStatus
        },
        updateMSWS(newStatus) {
            this.MSWS12 = newStatus
        },
        create() {
            this
                .$http
                .post('/record/create', {
                    date: this.date,
                    symptom: this.symptom,
                    relapse: this.relapse ? 1 : 2,
                    edss: this.edss,
                    mri: this.MRI,
                    t25fw: this.T25FW,
                    msws: this.MSWS12
                })
                .then(({ data }) => {
                    Materialize.toast(data.message, 3000)
                    this.$router.go({ name: 'record' })
                })
        }
    }
}
</script>

<style lang="stylus" scoped>
div.row
    margin-bottom 0 !important
.switch
    height 2.5rem
    position relative
    bottom 1.5rem
    left -1rem

.action-right
    position fixed
    top 0
    right 0
#record-form-container
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

</style>
