<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center row wrap>
        <v-flex xs12>
          <v-card color="transparent" flat>
            <v-card-text class="purple-color">
              <h1 class="text-xs-center">La flemme de chercher un bar {{ user ? user.pseudo : '' }} ?</h1>
              <h1 class="text-xs-center">On s'occupe de tout !</h1>
            </v-card-text>
          </v-card>
        </v-flex>

          <v-flex xs12 lg8 xl6>
            <search-bar
              class="search-bar"
              :keywords="keywords"
              v-model="selectedKeywords"
              @search="search"
            ></search-bar>
          </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</template>

<script>
import SearchBar from '@/components/SearchBar'

export default {
  name: 'Home',

  components: {
    SearchBar
  },

  data () {
    return {
      selectedKeywords: []
    }
  },

  computed: {
    user () {
      return this.$store.state.user
    },
    keywords () {
      return this.$store.state.keywords || []
    }
  },

  created () {
    this.$store.dispatch('keywords')
  },

  methods: {
    search () {
      if (this.selectedKeywords.length === 0) return

      this.$router.push(`/search?q=${this.selectedKeywords.join(',')}`)
    }
  }
}
</script>
