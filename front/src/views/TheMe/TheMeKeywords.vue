<template>
  <div>
    <v-card flat>
      <v-card-title class="headline">Vos mots clés</v-card-title>

      <v-card-text>
        <v-layout row wrap>
          <v-flex xs12 sm6>
            <v-autocomplete
              v-model="newKeywordsIds"
              :items="allowedUserKeywords"
              item-text="name"
              item-value="id"
              label="Nouveaux mots clés"
              multiple
            ></v-autocomplete>

            <v-btn
              color="secondary"
              :loading="loading"
              @click="addKeyword"
            >
              Ajouter
            </v-btn>
          </v-flex>

          <v-flex xs12 sm6>
            <v-chip
              v-for="(keyword, i) in user.keywords"
              :key="i"
              @input="deleteKeywordsOfUser(keyword.id)"
              outline
              color="primary"
              close
            >
              {{ keyword.name | capitalize }}
            </v-chip>
          </v-flex>
        </v-layout>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
  name: 'TheMeKeywords',

  filters: {
    capitalize (value) {
      if (!value) return ''
      value = value.toString()
      return value.charAt(0).toUpperCase() + value.slice(1)
    }
  },

  data () {
    return {
      newKeywordsIds: [],
      loading: false
    }
  },

  computed: {
    ...mapState(['user']),
    ...mapGetters(['allowedUserKeywords'])
  },

  methods: {
    ...mapActions([
      'addKeywordsToUser',
      'deleteKeywordsOfUser'
    ]),

    async addKeyword () {
      try {
        this.loading = true
        await this.addKeywordsToUser(this.newKeywordsIds)
      } catch (err) {
        this.$log.error(err)
      } finally {
        this.loading = false
        this.newKeywordsIds = []
      }
    }
  }
}
</script>
