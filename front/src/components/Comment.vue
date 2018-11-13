<template>
  <v-card class="pa-3 ml-2 mr-2 mt-3">

    <v-layout align-center justify-space-between fill-height>
      <v-avatar
      class="ml-3"
        slot="activator"
        size="42px"
      >
        <img class="mt-4" :src="avatar" alt="Avatar">
        <span class="pl-2 grey--text" > {{ comment.pseudo }}</span>
      </v-avatar>
      <span>{{ comment.datecom }} </span>
    </v-layout>
    <template v-if="!modify || this.$store.state.user.id !== comment.iduser">
    <p class="ml-5" v-html="comment.content"></p>
    <template v-if="this.$store.getters.isAuthenticated && this.$store.state.user.id === comment.iduser">
      <v-layout justify-end>
        <v-icon @click="$emit('change-modify')" >create</v-icon> <v-icon @click="dialog = true" >clear</v-icon>
        <v-dialog
          v-model="dialog"
          max-width="290"
        >
          <v-card>
            <v-card-title class="headline">Confirmez-vous la supression de ce commentaire?</v-card-title>
            <v-card-text>Toute suppression est définitive</v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="secondary"
                flat="flat"
                @click="dialog = false"
              >
                Refuser
              </v-btn>
              <v-btn
                color="secondary"
                flat="flat"
                @click="$emit('deleteComment',comment), dialog = false"
              >
                Accepter
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-layout>

    </template>
    </template>
    <template v-else>
      <v-form v-model="isValid" ref="comment" lazy-validation>
        <v-textarea
            :rules="test"
            class="mt-3"
            box
            v-model="comment.content"
            label="Modifier votre avis:"
            :value="comment.content"
          ></v-textarea>
          <v-layout justify-end>
            <v-btn
            medium
            color="secondary"
            @click="$emit('change-modify-false')"
            v-text="'Annuler'"
          ></v-btn>
          <v-btn
            medium
            color="secondary"
            @click="$emit('updateComment', comment)"
            v-text="'Valider'"
            :disabled="!isValid"
          ></v-btn>
        </v-layout>
      </v-form>
    </template>
  </v-card>
</template>

<script>
export default {
  name: 'Comment',

  data () {
    return {
      isValid: false,
      test: [v => v.length >= 3 || 'Min 3 caractères.'],
      dialog: false
    }
  },

  props: {
    modify: Boolean,
    comment: Object
  },

  computed: {
    avatar: function () {
      return 'https://api.adorable.io/avatars/48/' + this.comment.iduser.toString().toLowerCase().trim().replace(/[\s\W-]+/g, '-') + '@adorable.io.png'
    }
  }

}
</script>
