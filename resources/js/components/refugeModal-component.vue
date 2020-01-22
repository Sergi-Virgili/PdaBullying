<template>
  <div class="card">
    <div class="card-header">
      <img class="logo" v-if="refugeSelected" :src="refugeSelected.logoUrl" />
      <h3 v-if="refugeSelected  && !editMode">{{ refugeSelected.name }}</h3>
      <v-text-field v-if="refugeSelected  && editMode" v-model="refugeSelected.name" required></v-text-field>
      <p v-if="refugeSelected && !editMode">{{ refugeSelected.description }}</p>
      <v-text-field v-if="refugeSelected  && editMode" v-model="refugeSelected.description" required></v-text-field>

    </div>
    <v-form ref="form" lazy-validation>
      <v-text-field v-if="refugeSelected  && editMode" label="Dirección" v-model="refugeSelected.road" required></v-text-field>
      <p v-if="refugeSelected && !editMode">{{ refugeSelected.road }} numº{{ refugeSelected.house_number }},  {{ refugeSelected.city }}</p>
      <v-text-field v-if="refugeSelected  && editMode" label="Numero" v-model="refugeSelected.house_number" required></v-text-field>
      <v-text-field v-if="refugeSelected  && editMode" label="Ciudad" v-model="refugeSelected.city" required></v-text-field>
      <v-text-field v-if="refugeSelected  && editMode" label="Email" v-model="refugeSelected.email" required></v-text-field>
            <p v-if="refugeSelected && !editMode">{{ refugeSelected.email }}</p>
      <!-- <v-select
        v-if="refugeSelected  && editMode"
        v-model="select"
        :items="items"
        :rules="[v => !!v || 'Requerido']"
        label="Tipo de Recurso"
        required
      >
      </v-select>
            <p v-if="refugeSelected && !editMode">{{ refugeSelected.types }}</p> -->
      
    </v-form>
    <div class="card-footer">
      <button @click="OnClickAttachRefuge" class="btn btn-success">Al Meu Mapa</button>
      <button @click="OnClickDetachRefuge" class="btn btn-danger">Fora del Meu Mapa</button>
      <button v-if="refugeSelected && !editMode" v-on:click="OnClickEdit()" class="btn btn-success">Editar</button>
      <button v-if="refugeSelected && editMode" v-on:click="OnClickUpdate()" class="btn btn-success">Guardar</button>


    </div>
  </div>
</template>

<script>
export default {
  // props: ["refuge"],
  data() {
    return {
      refugeSelected: {},
      editMode: false
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get('/api/refuges/1').then(response => {
        this.refugeSelected = response.data;
      });
    },
    OnClickEdit(){
      this.editMode = true
      this.$emit("edit")
    },
    OnClickUpdate() {
      const params = {
        name: this.refugeSelected.name,
        description: this.refugeSelected.description,
        road: this.refugeSelected.road,
        hpuse_number: this.refugeSelected.house_number,
        city: this.refugeSelected.city,
        email: this.refugeSelected.email,
      };
      console.log(params)
      axios.put(`/api/refuges/${this.refuge.id}`, params).then((response) => {
      this.editMode = false;
      console.log(params);
      const refuge = response.data;
      this.$emit('update', refuge);
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
