<template>
  <div>
    <v-flex>
      <add-search-bar
        v-model="selectedText"
        @search="search"
      ></add-search-bar>
    </v-flex>

    <v-container fluid grid-list-xl>
      <v-progress-linear
        v-if="loading"
        color="secondary"
        height="4"
        indeterminate
      ></v-progress-linear>

      <v-alert
        :value="alert"
        type="info"
      >
        Désolé, mais votre recherche n'a rien donné.
        Essayez avec d'autres mots clés !
      </v-alert>

      <v-layout row wrap>
        <add-bar
          v-for="({ id, name, photoreference , rating, address, lng, lat, placeId}, i) in bars"
          :key="i"
          v-bind:id="id"
          :name="name"
          :photo-reference="photoreference"
          :rating="Number.parseFloat(rating)"
          :address="address"
          :lng="lng"
          :lat="lat"
          :placeId="placeId"
          @black="black"
          @liked="liked"
        ></add-bar>

      </v-layout>
    </v-container>
  </div>
</template>

<script>
import AddBar from '@/components/AddBar'
import AddSearchBar from '@/components/AddSearchBar'
// @keyup.enter="submit"

export default {
  name: 'TheAddSearch',

  components: {
    AddBar,
    AddSearchBar
  },

  props: {
    query: {
      type: Object,
      required: true
    }
  },

  data () {
    return {
      selectedText: '',
      bars: [],
      loading: true,
      alert: false
    }
  },

  watch: {
    query: {
      immediate: true,
      handler () {
        // this.$log.debug(this.query)

        this.selectedText = this.query.q
        this.loading = true

        this.$api.addBars(this.query)
          .then(bars => {
            this.bars = bars
            this.alert = false
          })
          .catch(err => {
            this.$log.error(err)

            if (err.response.status === 500) this.alert = true
          })
          .finally(() => (this.loading = false))
      }
    }
  },

  methods: {
    search () {
      if (this.selectedText === this.query.q) return
      if (this.selectedText.length === 0) return

      this.bars = []
      this.loading = true
      this.$router.push(`/addsearch?q=${this.selectedText.toLowerCase()}`)
    },
    async liked (bar) {
      try {
        await this.$api.likedListBar({
          data: { bar, 'list': 'liked', 'userPseudo': this.$store.state.user.pseudo }
        })
      } catch (err) {
        this.$log.error(err)
      }
    },
    async black (bar) {
      try {
        await this.$api.blackListBar({
          data: { bar, 'list': 'black', 'userPseudo': this.$store.state.user.pseudo }
        })
      } catch (err) {
        this.$log.error(err)
      }
    }
  }
}
</script>
