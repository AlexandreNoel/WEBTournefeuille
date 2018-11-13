<template>
  <div>
  <p class="display-2">
    Modération des avis
  </p>
  <v-data-table
    :headers="headers"
    :items="comments"
    class="elevation-1"
    :loading="loading"
  >
    <template slot="items" slot-scope="props">
      <td class="text-xs" > {{ props.item.pseudo }}</td>
      <td class="text-xs-left">{{ props.item.nameBar }}</td>
      <td class="text-xs-left">{{ props.item.content }}</td>
      <td class="text-xs-center"><v-icon medium @click="deleteComment(props.item.id)" >delete</v-icon></td>
    </template>
  </v-data-table>
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import Toaster from '@/toaster.js'

export default {
  name: 'Admin',
  data () {
    return {
      loading: true,
      comments: [],
      headers: [
        {
          text: 'Pseudo utlisateur',
          align: 'left',
          sortable: false,
          value: 'pseudo'
        },
        { text: 'Nom du bar', value: 'nameBar' },
        { text: 'Commentaire', value: 'content' },
        { text: 'Supprimer', value: null }
      ]
    }
  },

  computed: {
    ...mapState(['user']),
    ...mapGetters(['isAdmin'])
  },

  watch: {
    isAdmin () {
      if (!this.isAdmin) this.$router.push('/')
    }
  },

  created () {
    this.$api.getComments()
      .then(comments => {
        this.$log.debug(comments)
        this.comments = comments
      })
      .catch(err => {
        this.$log.error(err)
      })
      .finally(() => (this.loading = false))
  },

  methods: {
    async deleteComment (id) {
      if (id) {
        try {
          await this.$api.deleteCommentAdmin(id)

          this.comments = this.comments.filter(c => c.id !== id)

          Toaster.$emit('success', 'Avis supprimé avec succès.')
        } catch (err) {
          this.$log.error(err)
          this.checkError(err.response.status)
        }
      }
    }
  }
}
</script>
