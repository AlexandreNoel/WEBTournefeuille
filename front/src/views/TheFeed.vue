<template>
  <v-container fluid grid-list-xl>
    <v-layout row wrap>
      <v-flex sm12 md8 xl6>
        <v-card class="elevation-4">
          <v-card-title class="headline">
            Bienvenue sur votre FeedBar {{ user.pseudo }}
          </v-card-title>

          <v-card-text v-if="haveKeywords">
            <h4>Vos mots clés sont</h4>
            <v-chip
              v-for="(keyword, i) in user.keywords"
              :key="i"
              color="primary"
              outline
            >
              {{ keyword.name }}
            </v-chip>
          </v-card-text>
          <v-card-text v-else>
            Ajoutez des mots clés sur votre compte !
          </v-card-text>

          <v-card-actions>
            <v-btn to="/me" flat color="secondary">Modifier mes mots clés</v-btn>
            <v-btn to="/" flat color="secondary">Recherche personnalisée</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>

      <bar
        v-for="(bar, i) in bars"
        :key="i"
        :id="bar.id"
        :name="bar.name"
        :address="bar.address"
        :photoReference="bar.photoreference"
        :rating="Number.parseFloat(bar.rating)"
        @clicked="$router.push(`/bars/${$event}`)"
      ></bar>
    </v-layout>
  </v-container>
</template>

<script>
import { mapGetters } from 'vuex'
import Toaster from '@/toaster.js'
import Bar from '@/components/Bar'

export default {
  name: 'TheFeed',

  components: {
    Bar
  },

  data () {
    return {
      bars: []
    }
  },

  computed: {
    ...mapGetters(['isAuthenticated']),
    user: {
      get () { return this.$store.state.user },
      set (user) { this.$store.commit('user', user) }
    },
    haveKeywords () {
      return this.user.keywords && this.user.keywords.length > 0
    }
  },

  watch: {
    isAuthenticated () {
      if (!this.isAuthenticated) this.$router.push('/signin')
    }
  },

  async created () {
    try {
      this.user = await this.$api.getUserInfo(this.user.id)

      if (!this.user.keywords) return

      const query = this.user.keywords
        .map(k => k.name)
        .join(',')

      this.$log.debug('keywords: ', query)

      this.bars = await this.$api.getBars({ q: query })
    } catch (err) {
      this.$log.error(err)

      if (err.response.status === 401) {
        this.$store.dispatch('logout')
        Toaster.$emit('info', 'Votre session a expiré')
      }
    }
  }
}
</script>
