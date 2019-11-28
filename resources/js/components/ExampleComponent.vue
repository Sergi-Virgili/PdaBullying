<template>
  <div>
    <l-map class="map" :zoom="zoom" :min-zoom="3" :center="center">
      <l-tile-layer :url="url" />
      <l-marker :lat-lng="geoMarker" />
    </l-map>
  </div>
</template>

<script>
import { LMap, LTileLayer, LMarker } from "vue2-leaflet";

export default {
  components: {
    LMap,
    LTileLayer,
    LMarker
  },
  data() {
    return {
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      center: [51.505, -0.09],
      zoom: 13,
      markers: [],
      geoMarker: [51.505, -0.09]
    };
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