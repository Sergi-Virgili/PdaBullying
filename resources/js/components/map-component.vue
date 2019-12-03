<template>
  <div>
    <div class="row">
      <div class="card col-md-8">
        <div class="card-header">
          <button class="btn btn-success" @click="fetchData">PDA mapa</button>
          <button class="btn btn-success" @click="OnClickMyMap">Mi mapa</button>
          <button class="btn btn-success">+ Add Place</button>
        </div>
        <div class="card-body">
          <l-map
            class="map"
            :noBlockingAnimations="animation"
            :zoom="zoom"
            :min-zoom="3"
            :center="center"
          >
            <l-tile-layer :url="url" />
            <div v-for="(refuge, index) in refuges" :key="index">
              <l-marker :lat-lng="refuge.geoMarker" @click="OnClickRefuge(index, refuge.geoMarker)">
                <l-popup>
                  <div class="popUp">
                    <img :src="refuge.logoUrl" alt />
                    <div>{{ refuge.name }}</div>
                  </div>
                </l-popup>
              </l-marker>
            </div>
          </l-map>
        </div>
      </div>
      <refuge-component class="refugeSider col-md-3" :refugeSelected="refugeSelected"></refuge-component>
      <refugeNew-component class="refugeSider col-md-3"></refugeNew-component>
    </div>
    <refugeList-component :refuges="refuges" @selectRefuge="test(index)"></refugeList-component>
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
      refuges: [],
      refugeSelected: null
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get("/api/refuges").then(response => {
        this.refuges = response.data.refuge;
      });
    },

    centerMap(geoMarker) {
      this.center = geoMarker;
    },
    OnClickRefuge(index, geoMarker) {
      this.selectRefuge(index);
      this.centerMap(geoMarker);
    },
    selectRefuge(index) {
      this.refugeSelected = this.refuges[index];
      console.log(this.refuges[index]);
    },
    test(params) {
      alert(params);
    },
    OnClickMyMap() {
      this.fetchMyRefuges();
    },
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
  // width: 60%;
  height: 400px;
  //background-color: grey;
}
// .refugeSider {
//   width: 40%;
// }
.popUp {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>
