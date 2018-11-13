<template>
  <div v-if="bar">
    <v-flex xs12>
      <v-parallax class="para" height="400" :src="require('@/assets/img/bar.jpg')">
        <v-layout
          align-center
          column
          justify-center
        >
        <h1 class="display-3 font-weight-thin mb-5 pb-5">{{ bar.name }}</h1>
        </v-layout>
      </v-parallax>
      <v-card color="margin_test" class=" ml-5 mr-5 pt-5 mb-5 elevation-23" >
        <bar-info :photoReference="bar.photoreference" :keywords="bar.keywords" :rating="bar.rating"></bar-info>
        <v-divider class="mt-5 elevation-2 " light ></v-divider>
        <v-card color="" class=" pb-5">
          <v-card-title primary-title>
            <div class="display-1">Description</div>
          </v-card-title>
          <v-card-text>
            <div class="subheading">
              Nom : {{ bar.name }}
              <br>
              Addresse : {{ bar.address }}
            </div>
          </v-card-text>
          <v-container class="mapContainer">
            <v-card color="green lighten-5" class="pa-4 hidden-sm-and-down">
              <GmapMap
                :center="center"
                :zoom="15"
                map-type-id="terrain"
                style="width: 700px; height: 400px"
              >
                <GmapMarker
                    :position="marker.position"
                    clickable
                    draggable
                    @click="center = marker.position"
                />
              </GmapMap>
            </v-card>
          </v-container>
           <v-flex xs12 sm6 offset-sm3>
           <div class="comment-list">
              <comment
                @change-modify-false="modify = false"
                @change-modify="modify = true"
                v-for="comment in comments"
                :key="comment.idUser" :modify="modify"
                :comment="comment"
                @deleteComment="deleteComment"
                @updateComment="updateComment">
              </comment>
            </div>
            <template v-if="isAuthenticated && !modify">
              <comment-form :comment="comment" @submit="submit" v-model="submitted"  ></comment-form>
            </template>
          </v-flex>
        </v-card>
      </v-card>
    </v-flex>
  </div>
</template>

<script>
import Comment from '@/components/Comment'
import CommentForm from '@/components/CommentForm'
import BarInfo from '@/components/BarInfo'
import Toaster from '@/toaster.js'

export default {
  name: 'TheBar',

  components: {
    Comment,
    CommentForm,
    BarInfo
  },

  computed: {
    isAuthenticated () {
      return this.$store.getters.isAuthenticated
    }
  },

  data () {
    return {
      modify: false,
      options: { year: 'numeric', month: 'numeric', day: 'numeric', hour: 'numeric', minute: 'numeric' },
      today: new Date(),
      submitted: null,
      arrayComm: [],
      comment: Comment,
      comments: Array,
      tmpCom: Object,
      commentId: null,
      keywords: [],
      bar: null,
      loading: true,
      center: {
        lat: 10,
        lng: 10
      },
      marker: {
        position: {
          lat: 10,
          lng: 10
        }
      }
    }
  },

  created () {
    this.$api.getBar(this.$route.params.id)
      .then(bar => {
        this.$log.debug(bar)
        this.bar = bar
        this.comments = bar.comments
        this.bar.rating = Number.parseFloat(bar.rating)
        const position = {
          lat: Number.parseFloat(bar.lat),
          lng: Number.parseFloat(bar.lng)
        }
        this.marker.position = position
        this.center = position
        if (this.comments === undefined) {
          this.comments = []
        }
      })
      .catch(err => {
        this.$log.error(err)

        if (err.response.status === 404) this.$router.push('/')
      })
  },
  methods: {
    async submit (submitted) {
      if (submitted.content !== undefined) {
        try {
          await this.$api.addComment(this.bar.id, {
            content: submitted.content,
            idUser: this.$store.state.user.id,
            idBar: this.bar.id,
            dateCom: this.today.toLocaleDateString('fr-FR', this.options)
          })
          Toaster.$emit('success', 'Avis ajouté avec succès.')
          this.tmpCom = {
            content: submitted.content,
            datecom: this.today.toLocaleDateString('fr-FR', this.options),
            idbar: this.bar.id,
            iduser: this.$store.state.user.id,
            pseudo: this.$store.state.user.pseudo
          }
          this.comments.push(this.tmpCom)
          submitted.content = ''
        } catch (err) {
          this.$log.error(err)
          this.checkError(err.response.status)
        }
      } else {
        Toaster.$emit('error', 'Votre commentaire ne peut être vide')
      }
    },
    async deleteComment (comment) {
      if (comment) {
        try {
          await this.$api.getComment(this.$store.state.user.id, this.bar.id)
            .then(commentId => {
              this.$log.debug(commentId)
              comment.id = commentId.data.id
            })
          await this.$api.deleteComment(comment.id, this.bar.id)
          this.comments.splice(this.comments.findIndex(comment => comment.iduser === this.$store.state.user.id), 1)
          Toaster.$emit('success', 'Avis supprimé avec succès.')
        } catch (err) {
          this.$log.error(err)
          this.checkError(err.response.status)
        }
      }
    },
    async updateComment (comment) {
      if (comment) {
        try {
          comment.datecom = this.today.toLocaleDateString('fr-FR', this.options)
          await this.$api.updateComment(comment.id, this.bar.id, comment)
          this.modify = false
          Toaster.$emit('success', 'Avis modifié avec succès.')
        } catch (err) {
          this.$log.error(err)
          this.checkError(err.response.status)
        }
      }
    },
    checkError (error) {
      switch (error) {
        case 400:
          Toaster.$emit('error', 'Paramètres invalides.')
          break
        case 401:
          this.$store.dispatch('logout')
          Toaster.$emit('info', 'Votre session a expiré')
          break
        case 403:
          Toaster.$emit('error', 'Vous ne pouvez poster qu\'un seul avis par bar')
          break
        case 500:
          Toaster.$emit('error', 'Erreur interne.')
          break
        default:
          Toaster.$emit('error', 'Une erreur s\'est produite')
          break
      }
    }
  }
}
</script>

<style>
.mapContainer {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 805px;
}
.titled {
  margin-top: -100px;
}
.margin_test {
  margin-top: -48px;
}
.para {
  margin-top: -30px;
}
</style>
