<template>
  <section class="publiMap">
    <l-map
      class="map"
      :noBlockingAnimations="animation"
      :zoom="zoom"
      :min-zoom="3"
      :center="center"
      @click="OnClickPosition"
    >
      <l-tile-layer :url="url" />
      <div v-for="(refuge, index) in refuges" :key="index">
        <l-marker
          v-if="refuge.is_Public"
          :lat-lng="refuge.geoMarker"
          @click="OnClickRefuge(index, refuge.geoMarker)"
        >
          <l-popup>
            <div class="popUp">
              <img :src="refuge.logoUrl" alt />
              <div>{{ refuge.name }}</div>
            </div>
          </l-popup>
        </l-marker>
      </div>
    </l-map>
  </section>
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";

export default {
  props: ["refuges"],
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup
  },
  created() {
    console.log(this.refuges);
  },
  data() {
    return {
      url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      center: [41.3876768, 2.169259],
      zoom: 13,
      animation: true
    };
  },
  methods: {
    centerMap(geoMarker) {
      this.center = geoMarker;
      //console.log(geoMarker);
    },
    OnClickRefuge(index, geoMarker) {
      this.selectRefuge(index);
      this.centerMap(geoMarker);
    },
    selectRefuge(index) {
      this.refugeSelected = this.refuges[index];
      console.log(this.refuges[index]);
    },
    OnClickPosition(event) {
      this.openSider("newRefuge");
      this.newGeoMarker = [event.latlng.lat, event.latlng.lng];
      let refuge = {};
      refuge.geoMarker = this.newGeoMarker;
      this.refuges.push(refuge);
    }
  }
};
</script>

<style>
.map {
  min-height: 500px;
}
</style>