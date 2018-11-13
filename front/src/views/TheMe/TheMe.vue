<template>
  <div v-if="user" class="elevation-5">
    <v-parallax
      src="https://cdn.vuetifyjs.com/images/parallax/material.jpg"
      height="200"
    >
      <v-layout column>
        <v-spacer></v-spacer>
        <v-avatar size="80">
          <img
            src="https://scontent-cdt1-1.xx.fbcdn.net/v/t31.0-1/c282.0.960.960/p960x960/10506738_10150004552801856_220367501106153455_o.jpg?_nc_cat=1&_nc_ht=scontent-cdt1-1.xx&oh=38581a4d2787b796406d8c112566b69d&oe=5C3E0712"
            :alt="user.pseudo"
          >
        </v-avatar>
        <h1 class="display-2 font-weight-thin mb-3">{{ user.pseudo }}</h1>
      </v-layout>
    </v-parallax>

    <v-tabs
      slot="extension"
      v-model="tab"
      slider-color="secondary"
      grow
    >
      <v-tab>Mots clés</v-tab>
      <v-tab>Mon compte</v-tab>
    </v-tabs>

    <v-tabs-items v-model="tab">
      <v-tab-item>
        <the-me-keywords></the-me-keywords>
      </v-tab-item>

      <v-tab-item>
        <the-me-account></the-me-account>
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Toaster from '@/toaster.js'
import TheMeKeywords from './TheMeKeywords'
import TheMeAccount from './TheMeAccount'

export default {
  name: 'TheMe',

  components: {
    TheMeKeywords,
    TheMeAccount
  },

  data () {
    return {
      tab: 0
    }
  },

  computed: {
    ...mapGetters(['isAuthenticated']),
    user: {
      get () { return this.$store.state.user },
      set (user) { this.$store.commit('user', user) }
    }
  },

  watch: {
    isAuthenticated () {
      if (!this.isAuthenticated) this.$router.push('/signin')
    }
  },

  created () {
    this.$store.dispatch('keywords')

    this.$api.getUserInfo(this.user.id)
      .then(user => {
        this.$log.debug(user)

        user.keywords = user.keywords || []
        user.keywords.sort((a, b) => a.name.localeCompare(b.name))
        this.user = user
      })
      .catch(err => {
        this.$log.error(err)

        if (err.response.status === 401) {
          this.$store.dispatch('logout')
          Toaster.$emit('info', 'Votre session a expiré')
        }
      })
  }
}
</script>
