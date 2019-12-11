<template>
  <div class="card">
    <div class="card-header">Crea el Type</div>
    <div class="card-body">
      <label for="name">Name of the Type</label>
      <input class="form-control" type="text" name="name" id="name" v-model="name" />
      <label for="description">Description</label>
      <input
        class="form-control"
        type="text"
        name="description"
        id="description"
        v-model="description"
      />
      <button class="btn btn-success" @click="saveNewType">OK</button>
    </div>
  </div>
</template>

<script>
export default {
  props: [""],
  data() {
    return {
      name: "",
      description: ""
    };
  },
  saveNewType() {
    let formData = {
      name: this.name,
      description: this.description
    };

    axios.post("/api/types/", formData).then(response => console.log(response));
  }
};
</script>

<style>
</style>
