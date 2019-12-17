<template>
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        <input v-if="editMode" for="type-name" v-model="type.name">
        <lavel v-else for="type-name">{{type.name}}</lavel>
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
    console.log("Component mounted");
  },
  methods: {
    onClickDelete() {
      this.$emit("delete");
    },
    onClickEdit() {
      this.editMode = true
      this.$emit("edit");
    },
    onClickUpdate() {
      this.editMode = false
      this.$emit("update", type);
    }
  }
};
</script>

<style>
button {
  max-width: 100px;
}
</style>