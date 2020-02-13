<template>
  <v-list width="50px" dense>
    <v-list-item v-for="(item, index) in items" :key="index">
      <v-tooltip right v-if="currentUser || !item.private">
        <template v-slot:activator="{ on }">
          <v-icon color="#d5832e" v-on="on" @click="eventEmit(item.script)">{{ item.icon}}</v-icon>
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
        { title: "Localízame", 
          icon: "far fa-compass", 
          script: "geo",
          private: false
        },
        
        {
          title: "Filtra los activos segun el tipo de recurso",
          icon: "mdi-filter-variant",
          script: "openFilter",
          private: false
        },
        {
          title: "Añade un Recurso clickando en el mapa",
          icon: "fas fa-map-marker-alt",
          script: "addRefugeMode",
          private: true
        },
        {
          title: "Guarda el zoom y el centro del mapa actual en 'Mi Mapa'",
          icon: "fas fa-cog",
          script: "mapOptionsSave",
          private: true
        },
        
      ]
    };
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    }
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
