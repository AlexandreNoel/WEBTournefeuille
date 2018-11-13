<template>
  <v-snackbar
    v-model="snackbar"
    :color="color"
    :timeout="timeout"
    bottom
    left
  >
    {{ text }}
  </v-snackbar>
</template>

<script>
import Toaster from '@/toaster.js'

export default {
  name: 'Snackbar',

  data () {
    return {
      snackbar: false,
      color: null,
      text: null,
      timeout: 6000
    }
  },

  created () {
    Toaster.$on('toast', this.toast)
    Toaster.$on('info', this.info)
    Toaster.$on('success', this.success)
    Toaster.$on('warning', this.warning)
    Toaster.$on('error', this.error)
  },

  methods: {
    async toast (snack = {}) {
      this.snackbar = false
      await this.$nextTick()

      this.snackbar = true
      this.color = snack.color
      this.text = snack.text
    },

    info (msg) {
      this.toast({ color: 'info', text: msg })
    },

    success (msg) {
      this.toast({ color: 'success', text: msg })
    },

    warning (msg) {
      this.toast({ color: 'warning', text: msg })
    },

    error (msg) {
      this.toast({ color: 'error', text: msg })
    }
  }
}
</script>
