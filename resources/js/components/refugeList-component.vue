<template>
  <section class="refugeList" v-if="refuges">
    <h2>Lista de lugares</h2>
    <ul v-for="(refuge, index) in refuges" :key="index">
      <li @click="onClickSelect(index)">{{ refuge.name }}</li>
    </ul>
  </section>
</template>

<script>
export default {
  props: ["refuges"],
  mounted() {},
  methods: {
    onClickSelect(index) {
      this.$emit("selectRefuge", index, this.refuges[index].geoMarker);
    }
  }
};
</script>

<style></style>
