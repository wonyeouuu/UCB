<template lang="jade">
div.row.analysis-container
    div.row
        div.col.s12.m6(@click='$router.go({ name: "duration" })')
            div.card.grey.lighten-2
                div.card-content
                    span.card-title Anualize Relapse Rate
                    hr
                    p
                        |First Duration
                        span.float-right 0/times 0/year
                    p
                        |Second Duration
                        span.float-right 0/times 0/year
        div.col.s12.m6
            div.card.grey.lighten-2
                div.card-content
                    span.card-title Disease Progress
                    hr
                    p.danger(v-if='showDisease')
                        |There may be a concern of your disease progressing, please consult your doctor.
        div.col.s12.m6
            div.card.grey.lighten-2
                div.card-content
                    span.card-title
                        |List of Medication Take
                        i.material-icons.float-right play_arrows
        div.col.s12.m6
            div.card.grey.lighten-2
                div.card-content
                    span.card-title
                        |See graph
                        i.material-icons.float-right play_arrows
                    img.graph-image(src='/imgs/graph.png')
</template>

<script>
import { records, reminders, durations } from '../../vuex/getters'
import { fetchRecords, fetchReminders } from '../../vuex/actions'
import { symptomParser, mriParser } from '../../parser'
export default {
    vuex: {
        actions: {
            refreshRecords: fetchRecords,
            refreshReminders: fetchReminders
        },
        getters: {
            records,
            reminders,
            durations,
        }
    },
    ready() {
        this.refreshRecords()
        this.refreshReminders()
    },
    computed: {
        hasT2() {
            return this.records.filter(record => record.mri.indexOf('1') !== -1).length > 0
        },
        hasGD() {
            return this.records.filter(record => record.mri.indexOf('2') !== -1).length > 0
        },
        hasIncrease() {
            return this.records.filter(record => record.mri.indexOf('3') !== -1).length > 0
        },
        relapseCount() {
            return this.records.filter(record => parseInt(record.relapse, 10) === 1).length
        },
        showDisease() {
            return ((this.hasT2 || this.hasIncrease) && this.relapseCount === 1) ||
                    ((this.hasGD || this.hasIncrease) && this.relapseCount > 1)
        }
    },
    methods: {
        symptomParser,
        mriParser
    }
}
</script>

<style lang="stylus" scoped>
.float-right
    float right
.card-title
    font-weight 400
    font-size 20px
    line-height 26px !important
.graph-image
    margin-top 10px
    width 100%
.material-icons
    width 24px
    color gray
.danger
    color red !important
</style>
