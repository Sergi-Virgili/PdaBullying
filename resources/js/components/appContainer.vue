<template>
  <div>
    <v-app id="app">
      <v-navigation-drawer v-model="drawer" app style="z-index:10000">
        <v-list dense>
          <v-list-item :to="{name:'home'}" link>
            <v-list-item-action>
              <v-icon color="#d5832e">mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Home</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'map'}">
            <v-list-item-action>
              <v-icon color="#d5832e">mdi-map-marker-outline</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>PDA Mapa</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <template v-if="currentUser">
          <v-list-item :to="{name:'mymap'}" link>
            <v-list-item-action>
              <v-icon color="#d5832e">mdi-map-marker</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Mi Mapa</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'mycode'}" link>
            <v-list-item-action>
              <v-icon color="#d5832e">mdi-code-tags</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Mi Iframe</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item link>
            <v-list-item-action>
              <v-icon color="#d5832e">mdi-comment-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Contacto</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
            <v-divider></v-divider>
          <template v-if="isAdmin">
            <v-list-item :to="{name:'publish'}" link>
              <v-list-item-action>
                <v-icon color="#d5832e">mdi-publish</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Publicar</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item :to="{name:'users'}" link>
              <v-list-item-action>
                <v-icon color="#d5832e">mdi-human-greeting</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Usuarios</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item :to="{name:'types'}" link>
              <v-list-item-action>
                <v-icon color="#d5832e">mdi-folder</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Tipos</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-divider></v-divider>
          </template>
          <v-list-item :to="{name:'profile'}" link>
            <v-list-item-action>
              <v-icon color="#d5832e">mdi-account</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Profile</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
            <v-list-item @click.prevent="logout" link>
              <v-list-item-action>
                <v-icon color="#d5832e">fa-sign-out-alt</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Logout</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>
          <template v-if="!currentUser">
            <v-list-item :to="{name:'login'}" link>
              <v-list-item-action>
                <v-icon color="#d5832e">fa-sign-out-alt</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Login</v-list-item-title>
              </v-list-item-content>
            </v-list-item>

            <v-list-item :to="{name:'register'}" link>
              <v-list-item-action>
                <v-icon color="#d5832e">fa-sign-in-alt</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Register</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>
        </v-list>
      </v-navigation-drawer>

      <v-app-bar app color="white" style="z-index:9999">
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        <v-img
          src="/img/logo-pda-bullying.jpg"
          lazy-src="/img/logo-pda-bullying.jpg"
          class="grey lighten-2"
          max-width="50"
          max-height="200"
        ></v-img>
      </v-app-bar>

      <v-content>
        <v-container class="full-height" fluid>
          <v-row align="center" justify="center">
            <v-col class="text-center">
              <!-- <MainApp /> -->
              <router-view></router-view>

              <!-- <map-component class="map"></map-component> -->
            </v-col>
          </v-row>
        </v-container>
      </v-content>

      
    </v-app>
  </div>
</template>

<script>
import MainApp from "./MainApp";

export default {
  name: "app-container",
  components: {
    MainApp
  },
  props: {
    source: String
  },
  data: () => ({
    drawer: false,
    dialog: false
  }),
  methods: {
    logout() {
      this.$store.commit("logout");
      this.$router.push("/login");
    }
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser;
    },
    isAdmin() {
      return this.$store.getters.isAdmin;
    },

  }
};
</script>
<style>
a,
a:hover {
  text-decoration: none;
}
</style>
