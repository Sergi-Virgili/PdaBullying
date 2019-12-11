<template>
  <section class="map-wrapper">
    <publicMap-component class="map" :refuges="refuges"></publicMap-component>
  </section>
</template>

<script>
export default {
  data() {
    return {
      refuges: []
    };
  },
  created() {
    this.fetchMyRefuges();
  },
  methods: {
    fetchMyRefuges() {
      axios.get("/api/maps/1").then(response => {
        this.refuges = response.data;
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.map {
  height: 100vh;
  width: 100%;
}
.map-wrapper {
  height: 100vh;
  width: 100%;
}
</style>>
