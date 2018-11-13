<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center row wrap>
        <v-flex xs12>
          <v-card color="transparent" flat>
            <v-card-text class="purple-color">
              <h1 class="text-xs-center"> Alors {{ user ? user.pseudo : '' }}, tu trouves qu'un bar manque à la liste
                ?</h1>
              <h1 class="text-xs-center">On s'occupe de tout !</h1>
            </v-card-text>
          </v-card>
        </v-flex>

        <v-flex xs12 lg8 xl6>
          <add-search-bar
            v-model="selectedText"
            @search="search"
          ></add-search-bar>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</template>

<script>
import AddSearchBar from '@/components/AddSearchBar'

export default {
  name: 'AddHome',

  components: {
    AddSearchBar
  },

  data () {
    return {
      selectedText: ''
    }
  },

  computed: {
    user () {
      return this.$store.state.user
    }
  },

  methods: {
    search () {
      if (this.selectedText.length === 0) return

      this.$router.push(`/addsearch?q=${this.selectedText}`)
    }
  }
}
</script>
