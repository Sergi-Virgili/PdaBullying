<template>
  <div class="card">
    <div class="card-header">
      <h3>Crea tu un tipo de recurso</h3>
    </div>
    <div class="card-body">
      <form action v-on:submit.prevent="newType()">
        <div class="form-group">
          <a for="type">Nombre de tipo de recurso</a>
          <input type="text" class="form-control" name="type" v-model="name" />
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      name:'',
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    newType() {
      const params= {
        name: this.name,
      };
      this.name = '';
      axios.post(`/api/types`, params).then((response)=>{
        const type = response.data;
        this.$emit('new',type);
      });
    },
}
};
</script>

<style>
button {
  max-width: 100px;
}
</style>