<template>
  <v-app>
    <v-list width="50px" dense>
      <v-list-item v-for="item in items" :key="item">
        <v-tooltip right>
          <template v-slot:activator="{ on }">
            <v-icon v-on="on">{{ item.icon}}</v-icon>
          </template>
          <span>{{ item.title}}</span>
        </v-tooltip>
      </v-list-item>
    </v-list>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      drawer: true,
      items: [
        { title: "Add Place", icon: "fas fa-map-marker-alt" },
        { title: "Map Options", icon: "fas fa-cog" },
        { title: "Geo", icon: "far fa-compass" },
        { title: "Search", icon: "fas fa-search" }
      ],
      mini: true
    };
  }
};
</script>

<style>
</style>