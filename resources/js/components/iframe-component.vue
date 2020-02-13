<template>
  <section class="map-wrapper">
    <publicMap-component v-if="loaded" class="map" :refuges="refuges" :center="center" :zoom="zoom"></publicMap-component>
  </section>
</template>

<script>
export default {
  data() {
    return {
      refuges: [],
      center: "",
      zoom: "",
      loaded: false
    };
  },
  created() {
    this.fetchMyRefuges();
  },
  computed: {
    currentUser() {
      return this.$store.getters.currentUser
    }
  },
  methods: {
    fetchMyRefuges() {
      let link = ''
      if (this.currentUser) {
        link = `/api/maps/${this.currentUser.id}`
      }
        //TODO URL PROPS MAP ID
        axios.get(link).then(response => {
          this.refuges = response.data.refuges;
          this.center = response.data.center;
          this.zoom = response.data.zoom;
          this.loaded = true;
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.map {
  height: 100%;
  width: 100%;
}
.map-wrapper {
  height: 100%;
  width: 100%;
}
</style
>>
