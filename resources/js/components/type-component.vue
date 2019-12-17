<template>
  <div class="card">
    <div class="card-body">
      <div class="form-group">
        <lavel for="type-name">{{type.name}}</lavel>
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-danger" v-on:click="onClickDelete()">Eliminar</button>
      <button class="btn btn-default">Editar</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["type"],
  data() {
    return {};
  },
  mounted() {
    console.log("Component mounted");
  },
  methods: {
    onClickDelete() {
      this.$emit("delete");
    }
  }
};
</script>

<style>
button {
  max-width: 100px;
}
</style>