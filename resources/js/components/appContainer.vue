<template>
  <div>
    <v-app id="app">
      <v-navigation-drawer v-model="drawer" app style="z-index:10000">
        <v-list dense>
          <v-list-item :to="{name:'home'}" link>
            <v-list-item-action>
              <v-icon>mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Home</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'map'}">
            <v-list-item-action>
              <v-icon>mdi-map-marker-outline</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>PDA Mapa</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'mymap'}" link>
            <v-list-item-action>
              <v-icon>mdi-map-marker</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Mi Mapa</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'mycode'}" link>
            <v-list-item-action>
              <v-icon>mdi-code-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Mi Iframe</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-comment-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Contacto</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item :to="{name:'publish'}" link>
            <v-list-item-action>
              <v-icon>mdi-bus</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Publicar</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'users'}" link>
            <v-list-item-action>
              <v-icon>mdi-person</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Usuarios</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'types'}" link>
            <v-list-item-action>
              <v-icon>mdi-signs</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Tipos</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item :to="{name:'profile'}" link>
            <v-list-item-action>
              <v-icon>mdi-user</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Profile</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'login'}" link>
            <v-list-item-action>
              <v-icon>fa-sign-out-alt</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'register'}" link>
            <v-list-item-action>
              <v-icon>fa-sign-in-alt</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Register</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
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
              <router-view
               ></router-view>

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
    openDialog() {
      alert()
    }
  }
};
</script>
<style>
a,
a:hover {
  text-decoration: none;
}
</style>
