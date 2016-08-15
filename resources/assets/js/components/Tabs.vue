<template lang="jade">
div.row
    div.col.s12.no-padding
        ul.tabs
            li.tab.col.s4
                a(@click='$router.go({ name: "reminder" })', :class='{ active: $route.name == "reminder" }') Reminder
            li.tab.col.s4
                a(@click='$router.go({ name: "record" })', :class='{ active: $route.name == "record" }') Record
            li.tab.col.s4
                a(@click='$router.go({ name: "analysis" })', :class='{ active: $route.name == "analysis" }') Analysis
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
