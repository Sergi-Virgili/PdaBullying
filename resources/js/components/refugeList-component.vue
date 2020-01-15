
<template>
  <section class="refugeList" v-if="refuges">
    <h2>Lista de Activos</h2>
    <v-row justify="center">
      <v-expansion-panels accordion>
        <v-expansion-panel v-for="(refuge, index) in refuges" :key="index">
          <v-expansion-panel-header>
            <h6>{{ refuge.name }}</h6>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <p>Ciudad: {{refuge.id}}</p>
            <p>Tipos de Recurso: {{refuge.id}}</p>
            <p>Web:{{refuge.id}}</p>
            <p>Contacto {{refuge.id}}</p>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-row>
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
</style>
