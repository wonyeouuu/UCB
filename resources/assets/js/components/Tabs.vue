<template lang="jade">
div.row
    div.col.s12.no-padding
        ul.tabs
            li.tab.col.s4
                a Reminder
            li.tab.col.s4
                a Record
            li.tab.col.s4
                a Analysis
</template>

<script>
export default {
    ready() {
        $('ul.tabs').tabs()
    }
}
</script>

<style lang="stylus" scoped>
.no-padding
    padding 0
</style>
