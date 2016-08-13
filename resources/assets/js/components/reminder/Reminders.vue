<template lang="jade">
div.row.reminder-container
    div.col.s12.m6(v-for='i in 5')
        div.card.grey.lighten-2
            div.card-content
                span.card-title Card Title
                p I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.
            div.card-action
                a This is a link
                a This is a link

a.btn-floating.btn-large.waves-effect.waves-light(@click='$router.go({ name: "editReminder" })')
    i.material-icons add
</template>

<script>
export default {
  data: function () {
    return {
    }
  },
  computed: {},
  ready: function () {},
  attached: function () {},
  methods: {},
  components: {}
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
