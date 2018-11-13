<template>
  <v-app id="app">
    <v-toolbar app>
      <v-btn to="/" fab flat color="transparent" icon>
        <img src="./assets/img/logo2.png" alt="logo" height="60" width="60">
      </v-btn>

      <v-toolbar-title class="purple-color">Trouvemonbar.com</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-toolbar-items>
        <template v-if="isAuthenticated">
          <v-menu bottom left offset-y>
            <v-btn icon large slot="activator" color="primary">
              <v-icon>account_circle</v-icon>
            </v-btn>
            <v-list>
              <v-list-tile to="/admin" v-if="isAdmin">
                <v-list-tile-title>Administration</v-list-tile-title>
              </v-list-tile>
              <v-list-tile to="/feed">
                <v-list-tile-title>Mon feed</v-list-tile-title>
              </v-list-tile>
              <v-list-tile to="/me">
                <v-list-tile-title>Mon compte</v-list-tile-title>
              </v-list-tile>
              <v-list-tile @click="logout">
                <v-list-tile-title>Déconnexion</v-list-tile-title>
              </v-list-tile>
            </v-list>
          </v-menu>
        </template>

        <template v-else>
          <v-btn color="primary" flat to="/signup">S'inscrire</v-btn>
          <v-btn color="primary" flat to="/signin">Connexion</v-btn>
          </template>
      </v-toolbar-items>
    </v-toolbar>

    <v-content>
      <v-container>
        <v-fade-transition mode="out-in">
          <router-view/>
        </v-fade-transition>
      </v-container>
    </v-content>

    <snackbar></snackbar>
  </v-app>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'
import Snackbar from './components/Snackbar'

export default {
  name: 'App',

  components: {
    Snackbar
  },

  computed: {
    ...mapState(['user']),
    ...mapGetters(['isAuthenticated', 'isAdmin'])
  },

  methods: mapActions(['logout'])
}
</script>

<style>
.purple-color {
  color: #545463;
}
</style>
