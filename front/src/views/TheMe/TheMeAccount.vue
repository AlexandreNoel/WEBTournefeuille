<template>
  <div>
    <v-card flat>
      <v-card-title class="headline">Informations personnelles</v-card-title>

      <v-card-text>
        <v-flex xs12>
          <v-text-field
            label="Email"
            :value="user.email"
            readonly
          ></v-text-field>
        </v-flex>

        <v-flex xs12>
          <v-text-field
            label="Pseudo"
            :value="user.pseudo"
            readonly
          ></v-text-field>
        </v-flex>
      </v-card-text>

      <v-card-actions>
        <the-me-account-dialog></the-me-account-dialog>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import TheMeAccountDialog from './TheMeAccountDialog'

export default {
  name: 'TheMeAccount',

  components: {
    TheMeAccountDialog
  },

  computed: mapState(['user'])
}
</script>
