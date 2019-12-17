<template>
  <div class="card">
    <div class="card-header">
      <h3>Crea tu un tipo de recurso</h3>
    </div>
    <div class="card-body">
      <form action v-on:submit.prevent="newType()">
        <div class="form-group">
          <lavel for="type">Nombre de tipo de recurso</lavel>
          <input type="text" class="form-control" name="type" v-model="name" />
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    newType() {
      let type = {
        id: 2,
        description: this.description,
        name: this.name
      };
      this.$emit("new", type);
      this.name = "";
    }
  }
};
</script>

<style>
button {
  max-width: 100px;
}
</style>