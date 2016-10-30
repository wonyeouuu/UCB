<template lang="jade">
div.row.record-container
    div.col.s12.m6(v-for='record in records')
        div.card.grey.lighten-2
            div.card-content
                p
                    span {{ record.date.split(' ')[0] }}
                    span.pull-right
                        a(@click='$router.go({ name: "editRecord", params: { id: record.id } })') Edit
                p
                    span Clinical Symptom
                    span.pull-right {{ symptomParser(record.symptom) }}
                p
                    span Relapse
                    span.pull-right {{ record.relapse == 1 ? 'Yes' : 'No' }}
                p
                    span EDSS
                    span.pull-right {{ record.edss == 0 ? 'None' : record.edss }}
                p
                    span MRI
                    span.pull-right {{ record.mri == 0 ? 'None' : mriParser(record.mri) }}
                p
                    span T25FW
                    span.pull-right {{ record.t25fw == 0 ? 'None' : record.t25fw }}
                p
                    span MSWS-12
                    span.pull-right {{ record.msws == 0 ? 'None' : record.msws }}
a.btn-floating.btn-large.waves-effect.waves-light(@click='$router.go({ name: "createRecord" })')
    i.material-icons add
</template>

<script>
import { records } from '../../vuex/getters'
import { fetchRecords } from '../../vuex/actions'
import { symptomParser, mriParser } from '../../parser'
export default {
    vuex: {
        actions: {
            refresh: fetchRecords
        },
        getters: {
            records
        }
    },
    ready() {
        this.refresh()
    },
    methods: {
        symptomParser,
        mriParser
    }
}
</script>

<style lang="stylus" scoped>
.btn-floating
    position fixed
    bottom 1rem
    right 1rem
.pull-right
    float right
    overflow-x scroll
    white-space nowrap
    width 30vw
.pull-left
    float left
.card-content
    font-size 1.2rem

</style>
