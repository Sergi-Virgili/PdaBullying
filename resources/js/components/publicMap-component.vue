<template>
  <section class="publiMap">
    <l-map v-if="isLoaded"
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
          :icon="icon"
          @click="OnClickRefuge(index, refuge.geoMarker)"
        >
          <l-popup>
            <div class="popUp">
              <l-popup>
              <div class="popUp">
                <img :src="refuge.logoUrl" alt />
                <h2>{{ refuge.name }}</h2>
                <div class="email">
                <v-icon small color="teal darken-2">mdi-email</v-icon>
                <h3>{{ refuge.email }}</h3>
                </div>
                <h3>{{ refuge.phone }}</h3>
              </div>
            </l-popup>
            </div>
          </l-popup>
        </l-marker>
      </div>
    </l-map>
  </section>
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";
import { LatLng, icon } from "leaflet";
export default {
  props: {
    refuges: Array,
    center: {
     
      default: [41.3876768, 2.169259]
    },
    zoom: {
      
      default: 13 
      }
  },
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
      // tcenter: [0,0],
      // tzoom: 13,
      animation: true,
      isLoaded:true,
      icon: icon({
        iconUrl: "/img/icons8-marker-30.png",
        iconSize: [30, 30]
        //iconAnchor: [16, 37]
      }),
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
.popUp {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.popUp h2{
  font-size: 14px;
}

.email{
  display: inline-block;
}

.popUp h3{
  font-size: 13px;
  font-weight: bold;
 
}

.button_list {
  width: 100%;
}
</style>