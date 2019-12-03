<template>
  <div class="card">
    <div class="card-header">
      <img v-if="refugeSelected" :src="refugeSelected.logoUrl" />
      <h3 v-if="refugeSelected">{{ refugeSelected.name }}</h3>
    </div>
  </div>
</template>

<script>
export default {
  props: ["refugeSelected"]
};
</script>

<style></style>
