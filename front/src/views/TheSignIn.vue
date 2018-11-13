<template>
  <v-content>
    <v-container fluid>
      <v-layout align-center justify-center>
        <v-flex xs12 sm8 md6 lg4>
          <v-card class="elevation-12">
            <v-toolbar dark color="primary">
              <v-toolbar-title>Formulaire de connexion</v-toolbar-title>
              <v-spacer></v-spacer>
            </v-toolbar>

            <v-card-text>
              <v-form v-model="isValid" ref="login" lazy-validation>
                <v-text-field
                  v-model="login"
                  prepend-icon="person"
                  name="login"
                  label="Pseudo ou adresse email"
                  type="text"
                  :rules="rules"
                  @keyup.enter="submit"
                ></v-text-field>

                <v-text-field
                  v-model="password"
                  id="password"
                  prepend-icon="lock"
                  name="password"
                  label="Mot de passe"
                  type="password"
                  :rules="rules"
                  @keyup.enter="submit"
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
                Connexion
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-content>
</template>

<script>
import Toaster from '@/toaster.js'
import { mapGetters } from 'vuex'

export default {
  name: 'TheSignIn',

  props: {
    source: String
  },

  data () {
    return {
      drawer: null,
      isValid: false,
      login: '',
      password: '',
      rules: [
        value => value.length >= 3 || 'Min 3 caractères.',
        value => value.length < 25 || 'Max 25 caractères.',
        value => !!value || 'Obligatoire.'
      ]
    }
  },

  computed: mapGetters(['isAdmin']),

  methods: {
    async submit () {
      if (!this.$refs.login.validate()) return

      try {
        await this.$store.dispatch('login', {
          login: this.login,
          password: this.password
        })

        if (this.isAdmin) {
          return this.$router.push('/admin')
        }
        this.$router.push('/feed')
      } catch (err) {
        this.$log.error(err)

        Toaster.$emit('error', 'Login ou Mot de passe incorrect')
      }
    }
  }
}
</script>
