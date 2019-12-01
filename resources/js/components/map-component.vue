<template>
  <div>
    <l-map
      class="map"
      :noBlockingAnimations="animation"
      :zoom="zoom"
      :min-zoom="3"
      :center="center"
    >
      <l-tile-layer :url="url" />
      <l-marker
        v-for="refuge in refuges"
        :key="refuge.index"
        :lat-lng="refuge.geoMarker"
        @click="centerMap(refuge.geoMarker)"
      >
        <l-popup>{{ refuge.name }}</l-popup>
      </l-marker>
    </l-map>
  </div>
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";
import axios from "axios";

export default {
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup
  },
  data() {
    return {
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      center: [41.3876768, 2.169259],
      zoom: 13,
      animation: true,
      refuges: []
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get("/api/refuges").then(response => {
        this.refuges = response.data.refuge;
        console.log(this.refuges);
      });
    },
    //TODO: ANIMATE CENTER MAP
    centerMap(geoMarker) {
      console.log(geoMarker);
      this.center = geoMarker;
    }
  }
};
</script>
<style lang="scss" scoped>
.map {
  width: 100%;
  height: 400px;
  //background-color: grey;
}
</style>
