<template>
  <div class="card">
    <div class="card-header">
      <img class="logo" v-if="refugeSelected" :src="refugeSelected.logoUrl" />
      <h3 v-if="refugeSelected">{{ refugeSelected.name }}</h3>
      <p v-if="refugeSelected">{{ refugeSelected.description }}</p>
    </div>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-text-field v-model="name" label="Nombre" required></v-text-field>

      <v-text-field v-model="adress" label="Direcció" required></v-text-field>
      <v-text-field v-model="city" label="Ciutat" required></v-text-field>
      <v-text-field v-model="mail" label="Contacte" required></v-text-field>
      <v-text-field v-model="Description" label="Descripció" required></v-text-field>
      <v-select
        v-model="select"
        :items="items"
        :rules="[v => !!v || 'Requerido']"
        label="Tipo de Recurso"
        required
      ></v-select>
    </v-form>
    <div class="card-footer">
      <button @click="OnClickAttachRefuge" class="btn btn-success">Al Meu Mapa</button>
      <button @click="OnClickDetachRefuge" class="btn btn-danger">Fora del Meu Mapa</button>
    </div>
  </div>
</template>

<script>
export default {
  // props: ["refugeSelected"],
  data() {
    return {
      refugeSelected: {}
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get("/api/refuges/1").then(response => {
        this.refugeSelected = response.data;
      });
    },
    OnClickAttachRefuge() {
      axios.get(`/api/maps/attach/${this.refugeSelected.id}`);
      //this.$emit("attachRefuge", this.refugeSelected.id);
    },
    OnClickDetachRefuge() {
      axios.get(`/api/maps/detach/${this.refugeSelected.id}`).then(response => {
        this.$emit("detachRefuge", this.refugeSelected.id);
      });
    }
  }
};
</script>

<style>
h3 {
  color: orange;
  padding: 1%;
}
.logo {
  width: 120px;
}
</style>
