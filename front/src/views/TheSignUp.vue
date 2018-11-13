<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6 lg4>
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
              <v-toolbar-title>Inscription</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>
            <v-card-text color="primary">
              <v-form v-model="isValid" ref="signup" lazy-validation>
                <v-text-field
                  label="Pseudo"
                  v-model="pseudo"
                  :rules="[rules.required,rules.minCounter,rules.maxCounter]"
                  @keyup.enter="submit"
                  required
                ></v-text-field>
                <v-text-field
                  label="Email"
                  v-model="email"
                  :rules="[rules.required,rules.email]"
                  @keyup.enter="submit"
                  required
                ></v-text-field>
                <span class="caption grey--text text--darken-1">
                Cette email sera utilisé pour vérifier votre compte.
                </span>
                <v-text-field
                  label="Mot de passe"
                  type="password"
                  v-model="password"
                  :rules="[rules.required,rules.minCounter,rules.maxCounter]"
                  @keyup.enter="submit"
                  required
                ></v-text-field>
                <v-text-field
                  label="Confirmez le mot de passe"
                  type="password" v-model="confirmedPassword"
                  :rules="[rules.required,rules.minCounter,rules.maxCounter,rules.passwordMatch]"
                  @keyup.enter="submit"
                  required
                ></v-text-field>
                <span class="caption grey--text text--darken-1">
                Veuillez entrer un mot de passe pour votre compte
                </span>
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn
                    color="secondary"
                    @click="submit"
                    :disabled="!isValid"
                  >
                    Continuer
                  </v-btn>
                </v-card-actions>
              </v-form>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</template>

<script>
import Toaster from '@/toaster'

export default {
  name: 'TheSignUp',

  data () {
    return {
      step: 1,
      isValid: false,
      pseudo: '',
      email: '',
      password: '',
      confirmedPassword: '',
      rules: {
        email: value => {
          const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          return pattern.test(value) || 'Invalid e-mail.'
        },
        minCounter: value => value.length >= 3 || 'Min 3 caractères.',
        maxCounter: value => value.length < 25 || 'Max 25 caractères.',
        passwordMatch: value => value === this.password || 'Password must match',
        required: value => !!value || 'Required.'
      }
    }
  },

  methods: {
    async submit () {
      if (!this.$refs.signup.validate()) return
      try {
        await this.$api.signup({
          email: this.email,
          pseudo: this.pseudo,
          password: this.password
        })

        Toaster.$emit('success', 'Inscription réussie.')

        this.$router.push('/signin')
      } catch (err) {
        this.$log.error(err)

        switch (err.response.status) {
          case 400:
            Toaster.$emit('error', 'Paramètres invalides.')
            break
          default:
            Toaster.$emit('error', 'Erreur interne.')
            break
        }
      }
    }
  }
}
</script>
