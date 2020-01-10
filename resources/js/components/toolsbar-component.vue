<template>
  
    <v-list width="50px" dense>
      <v-list-item v-for="(item, index) in items" :key="index">
        <v-tooltip right>
          <template v-slot:activator="{ on }">
            <v-icon v-on="on" @click="eventEmit('addRefugeMode')">{{ item.icon}}</v-icon>
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
        { title: "Add Place", icon: "fas fa-map-marker-alt", script: "addRefuge"},
        { title: "Map Options", icon: "fas fa-cog" },
        { title: "Geo", icon: "far fa-compass" },
        { title: "Search", icon: "fas fa-search" }
      ],
      
    };
  },
  methods: {
      eventEmit(event) {
          
          this.$emit(event)
      }
  }
};
</script>

<style>
</style>