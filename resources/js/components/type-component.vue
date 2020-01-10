<template>
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        <input v-if="editMode" for="type-name" v-model="type.name">
        <p v-else for="type-name">{{type.name}}</p>
      </div>
    </div>
    <div class="card-footer">
      <button v-if="editMode" class="btn btn-success" v-on:click="onClickUpdate()">Guardar Cambios</button>
       <button v-else class="btn btn-default" v-on:click="onClickEdit()">Editar</button>
       <button class="btn btn-danger" v-on:click="onClickDelete()">Eliminar</button>
     
    </div>
  </div>
</template>

<script>
export default {
  props: ["type"],
  data() {
    return {
      editMode: false
    };
  },
  mounted() {
    console.log(this.type);
  },
  methods: {
    onClickDelete() {
      axios.delete(`/api/types/${this.type.id}`).then(() => {
      this.$emit("delete")})
    },
    onClickEdit() {
      this.editMode = true
      this.$emit("edit");
    },
    onClickUpdate() {
      const params = {
        name: this.type.name
      };
      console.log(params)
      axios.put(`/api/types/${this.type.id}`, params).then((response) => {
      this.editMode = false;
      console.log(params);
      const type = response.data;
      this.$emit('update', type);
      });
    }
  }
}
</script>

<style>
button {
  max-width: 100px;
}
</style>