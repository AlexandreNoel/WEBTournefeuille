<template>
  <v-dialog v-model="dialog" width="350">
    <v-btn
      slot="activator"
      color="secondary"
      flat
      dark
    >
      Modifier mon mot de passe
    </v-btn>

    <v-card>
      <v-card-text>
        <v-form v-model="isValid" ref="user" lazy-validation>
          <v-text-field
            v-model="currentPassword"
            type="password"
            label="Mot de passe actuel"
            :rules="passwordRules"
          ></v-text-field>

          <v-text-field
            v-model="password"
            type="password"
            label="Nouveau mot de passe"
            :rules="[...passwordRules, differentPasswordRules]"
          ></v-text-field>

          <v-text-field
            v-model="passwordConfirmation"
            type="password"
            label="Confirmation"
            :rules="[samePasswordRules]"
          ></v-text-field>
        </v-form>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="secondary"
          @click="submit"
          :disabled="!isValid"
        >
          Valider
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapState } from 'vuex'
import Toaster from '@/toaster'

export default {
  name: 'TheMeAccountDialog',

  data () {
    return {
      dialog: false,
      isValid: false,
      passwordRules: [
        v => v.length >= 3 || 'Min 3 caractères.',
        v => v.length < 25 || 'Max 25 caractères.'
      ],
      differentPasswordRules: v => v !== this.currentPassword || 'Doit être différent du mot de passe actuel',
      samePasswordRules: v => v === this.password || 'Doit correspondre au nouveau mot de passe',
      currentPassword: '',
      password: '',
      passwordConfirmation: ''
    }
  },

  computed: mapState(['user']),

  methods: {
    async submit () {
      if (!this.$refs.user.validate()) return

      try {
        await this.$api.updateUser({
          id: this.user.id,
          password: this.password,
          currentPassword: this.currentPassword
        })
        Toaster.$emit('success', 'Mot de passe modifié.')
      } catch (err) {
        this.$log.error(err)

        switch (err.response.status) {
          case 401:
            Toaster.$emit('error', 'Opération non autorisé.')
            break
          case 403:
            Toaster.$emit('error', 'Mot de passe incorect.')
            break
          case 500:
            Toaster.$emit('error', 'Erreur interne.')
            break
          default:
            Toaster.$emit('error', 'Une erreur s\'est produite.')
            break
        }
      }
      this.reset()
      this.dialog = false
    },

    reset () {
      this.$refs.user.reset()
      this.currentPassword = ''
      this.password = ''
      this.passwordConfirmation = ''
    }
  }
}
</script>
