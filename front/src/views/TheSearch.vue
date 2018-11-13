<template>
  <div>
    <search-bar
      :keywords="keywords"
      v-model="selectedKeywords"
      @search="search"
    ></search-bar>

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
        <bar
          v-for="({ id, name, address, keywords, photoreference, rating }, i) in bars"
          :key="i"
          v-bind:id="id"
          :name="name"
          :address="address"
          :keywords="keywords"
          :photo-reference="photoreference"
          :rating="Number.parseFloat(rating)"
          @clicked="barClicked"
        ></bar>
      </v-layout>
    </v-container>
    <v-btn
      color="secondary"
      @click='addbar'
    >
      Un bar manque à la liste ?
    </v-btn>
  </div>
</template>

<script>
import Bar from '@/components/Bar'
import SearchBar from '@/components/SearchBar'

export default {
  name: 'TheSearch',

  components: {
    Bar,
    SearchBar
  },

  props: {
    query: {
      type: Object,
      required: true
    }
  },

  data () {
    return {
      selectedKeywords: [],
      bars: [],
      loading: true,
      alert: false
    }
  },

  computed: {
    keywords () {
      return this.$store.state.keywords || []
    }
  },

  created () {
    this.$store.dispatch('keywords')
  },

  watch: {
    query: {
      immediate: true,
      handler () {
        this.$log.debug(this.query)

        this.selectedKeywords = this.query.q.split(',')
        this.loading = true

        this.$api.getBars(this.query)
          .then(bars => {
            this.bars = bars
            this.alert = false
          })
          .catch(err => {
            this.$log.error(err)

            if (err.response.status === 404) this.alert = true
          })
          .finally(() => (this.loading = false))
      }
    }
  },

  methods: {
    addbar () {
      this.$router.push(`/addbar`)
    },
    search () {
      if (this.selectedKeywords.join(',') === this.query.q) return
      if (this.selectedKeywords.length === 0) return

      this.bars = []
      this.loading = true
      this.$router.push(`/search?q=${this.selectedKeywords.join(',')}`)
    },

    barClicked (id) {
      this.$log.debug('clicked', id)

      this.$router.push(`/bars/${id}`)
    }
  }
}
</script>
