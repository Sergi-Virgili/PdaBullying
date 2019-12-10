<template>
  <div class="card">
    <div class="card-header">
      <img v-if="refugeSelected" :src="refugeSelected.logoUrl" />
      <h3 v-if="refugeSelected">{{ refugeSelected.name }}</h3>
    </div>
    <div class="card-footer">
      <button @click="OnClickAttachRefuge" class="btn btn-success">Al Meu Mapa</button>
      <button @click="OnClickDetachRefuge" class="btn btn-danger">Fora del Meu Mapa</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["refugeSelected"],
  methods: {
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

<style></style>
