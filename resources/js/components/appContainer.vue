<template>
  <div>
    <v-app id="app">
      <v-navigation-drawer v-model="drawer" app style="z-index:10000">
        <v-list dense>
          <v-list-item :to="{name:'home'}" link>
            <v-list-item-action>
              <v-icon>fa-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Home</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'map'}">
            <v-list-item-action>
              <v-icon>fa-map-marker-alt</v-icon>
            </v-list-item-action>

            <v-list-item-content>
              <v-list-item-title>PDA Mapa</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'mymap'}" link>
            <v-list-item-action>
              <v-icon>mdi-home</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Mi Mapa</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'mycode'}" link>
            <v-list-item-action>
              <v-icon>fa-code</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Mi Iframe</v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          <v-list-item link>
            <v-list-item-action>
              <v-icon>fa-comment</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Contacto</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item :to="{name:'publish'}" link>
            <v-list-item-action>
              <v-icon>fa-bus</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Publicar</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'users'}" link>
            <v-list-item-action>
              <v-icon>fa-user</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Usuarios</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item :to="{name:'types'}" link>
            <v-list-item-action>
              <v-icon>fa-map-signs</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Tipos</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>
          <v-list-item :to="{name:'profile'}" link>
            <v-list-item-action>
              <v-icon>fa-user-circle</v-icon>
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
          src="https://pdabullying.com/img/logo.png"
          lazy-src="https://pdabullying.com/img/logo.png"
          class="grey lighten-2"
          max-width="150"
          max-height="300"
        ></v-img>
      </v-app-bar>

      <v-content>
        <v-container class="full-height" fluid>
          <v-row align="center" justify="center">
            <v-col class="text-center">
              <MainApp />
              <!-- <map-component class="map"></map-component> -->
            </v-col>
          </v-row>
        </v-container>
      </v-content>

      <v-dialog v-model="dialog" width="600px" style="z-index:1000000">
        <template v-slot:activator="{ on }">
          <v-btn color="primary" dark v-on="on">Open Dialog</v-btn>
        </template>
        <!-- <refugeModal-component></refugeModal-component> -->
        <refugeNew-component></refugeNew-component>
      </v-dialog>
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
  methods: {}
};
</script>
<style>
a,
a:hover {
  text-decoration: none;
}
</style>
