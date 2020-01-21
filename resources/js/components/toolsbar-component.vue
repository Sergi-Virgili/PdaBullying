<template>
  <v-list width="50px" dense>
    <v-list-item v-for="(item, index) in items" :key="index">
      <v-tooltip right>
        <template v-slot:activator="{ on }">
          <v-icon v-on="on" @click="eventEmit(item.script)">{{ item.icon}}</v-icon>
        </template>
        <span>{{ item.title}}</span>
      </v-tooltip>
    </v-list-item>
  </v-list>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {
          title: "Añade un Recurso clickando en el mapa",
          icon: "fas fa-map-marker-alt",
          script: "addRefugeMode"
        },
        {
          title: "Guarda el zoom y el centro del mapa actual en 'Mi Mapa'",
          icon: "fas fa-cog",
          script: "mapOptionsSave"
        },
        { title: "Localízame", icon: "far fa-compass", script: "geo" }
        // { title: "Search", icon: "fas fa-search" }
      ]
    };
  },
  methods: {
    eventEmit(event) {
      this.$emit(event);
    }
  }
};
</script>

<style>
</style>
