<template>
  <section class="refugeList" v-if="refuges">
      ¡<i style="color:orange" class="fas fa-angle-down fa-2x"></i>
      <h2>Lista de Activos</h2>
    
      <v-expansion-panels accordion>
        <v-expansion-panel v-for="(refuge, index) in refuges" :key="index">
          <v-expansion-panel-header>
            <h6>{{ refuge.name }}</h6>
          </v-expansion-panel-header>
          <v-expansion-panel-content >
            <p>Ciudad: {{refuge.city}}</p>
            <p>Tipos de Recurso: {{refuge.id}}</p>
            <p>Web:{{refuge.web}}</p>
            <p>Contacto {{refuge.email}}</p>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
 
  </section>
</template>


<script>
export default {
  props: ["refuges"],
  mounted() {
    console.log(this.refuges);
  },
  methods: {
    onClickSelect(index) {
      this.$emit("selectRefuge", index, this.refuges[index].geoMarker);
    }
  }
};
</script>

<style>
h2 {
  padding: 1%;
  color: orange;
}
.refugeList {
  width: 100%;
}
</style>