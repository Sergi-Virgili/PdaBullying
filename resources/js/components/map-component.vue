<template>
  <div class="map-wraper">
    <div class>
      <v-navigation-drawer
        style="z-index:2"
        color="rgba(255, 255, 255, 1"
        floating
        permanent
        absolute
        :mini-variant="true"
        :mini-variant-width="50"
      >
        <toolsbar-component @addRefugeMode="addRefugeMode"></toolsbar-component>
      </v-navigation-drawer>
      <!-- TOOLS COMPONENT -->
      <!-- <div class="card-header">
          <button class="btn btn-success" @click="fetchData">PDA mapa</button>
          <button class="btn btn-success" @click="OnClickMyMap">Mi mapa</button>
          <button class="btn btn-success" @click="newRefuge">+ Add Place</button>
          <button class="btn btn-success" @click="optionsMyMap">Map Options</button>
          <button class="btn btn-success" @click="geo">Geo</button>
          <button class="btn btn-success" @click="OpenSearcher">Buscar</button>
      </div>-->
      <div class>
        <l-map
          style="z-index:1;"
          class="map"
          :noBlockingAnimations="animation"
          :zoom="zoom"
          :min-zoom="3"
          :center="center"
          @click="OnClickPosition"
          @update:center="onMove"
          @update:zoom="onZoom"
        >
          <l-tile-layer :url="url" />
          <div v-for="(refuge, index) in refuges" :key="index">
            <l-marker
              class="marker"
              v-if="refuge.is_Public"
              :lat-lng="refuge.geoMarker"
              :icon="icon"
              @click="OnClickRefuge(index, refuge.geoMarker)"
            >
              <l-popup>
                <div class="popUp">
                  <img :src="refuge.logoUrl" alt />
                  <div>{{ refuge.name }}</div>
                </div>
              </l-popup>
            </l-marker>

            <l-marker
              class="marker"
              v-if="!refuge.is_Public"
              :lat-lng="refuge.geoMarker"
              :icon="icon2"
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
        <v-navigation-drawer v-model="drawerRight" right absolute temporary>
          <refuge-component
            v-if="sider == 'refuge'"
            class="refugeSider"
            :refugeSelected="refugeSelected"
            @attachRefuge="attachRefuge"
            @detachRefuge="detachRefuge"
          ></refuge-component>
          <refugeNew-component
            v-if="sider == 'newRefuge'"
            :newGeoMarker="newGeoMarker"
            class="refugeSider"
          ></refugeNew-component>
        </v-navigation-drawer>
      </div>
      <v-bottom-sheet v-model="mode.list">
        <template v-slot:activator="{ on }">
          <v-btn width="100%" v-on="on">
            <i style="color:orange" class="fas fa-angle-down fa-2x"></i>
          </v-btn>
        </template>
        <v-content>
          <v-card>
            <refugeList-component :refuges="refuges" @selectRefuge="test(index)"></refugeList-component>
          </v-card>
        </v-content>
      </v-bottom-sheet>
    </div>
    <!-- <section class="sider" v-if="sider">
        <refuge-component
          v-if="sider == 'refuge'"
          class="refugeSider"
          :refugeSelected="refugeSelected"
          @attachRefuge="attachRefuge"
          @detachRefuge="detachRefuge"
        ></refuge-component>
        <refugeNew-component
          v-if="sider == 'newRefuge'"
          :newGeoMarker="newGeoMarker"
          class="refugeSider"
        ></refugeNew-component>
        <mapOptions-component
          :newCenter="center"
          :myMapCenter="myMapCenter"
          :myMapZoom="myMapZoom"
          :newZoom="zoom"
          v-if="sider == 'mapOptions'"
          class="refugeSider"
        ></mapOptions-component>
        <mapSearch-component v-if="sider == 'mapSearch'" class="refugeSider"></mapSearch-component>
    </section>-->
  </div>

  <!-- <refugeList-component :refuges="refuges" @selectRefuge="test(index)"></refugeList-component> -->
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";
import axios from "axios";
import geoFindMe from "../services/geolocationService";
import { LatLng, icon } from "leaflet";

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
      refugeSelected: null,
      newGeoMarker: null,
      sider: "",
      myMapCenter: "",
      myMapZoom: "",
      icon: icon({
        iconUrl: "img/icons8-marker-30.png",
        iconSize: [30, 30]
        //iconAnchor: [16, 37]
      }),
      icon2: icon({
        iconUrl: "img/icons8-marker-16.png",
        iconSize: [30, 30]
        //iconAnchor: [16, 37]
      }),
      drawerRight: false,
      mode: {
        list: false,
        addRefuge: false
      }
    };
  },
  created() {
    this.fetchData();
    this.fetchMyMap();
  },
  methods: {
    addRefugeMode() {
      //TODO CHANGE CURSOS IN MAP
      this.mode.addRefuge = true;
    },
    fetchMyMap() {
      axios.get("/api/maps/1").then(response => {
        this.myMapCenter = response.data.center;
        this.myMapZoom = response.data.zoom;
      });
    },
    OpenSearcher() {
      this.sider = "mapSearch";
    },
    onZoom(event) {
      this.zoom = event;
    },
    onMove(event) {
      let geoMarker = [event.lat, event.lng];
      this.centerMap(geoMarker);
    },
    geo() {
      geoFindMe.findMe().then(res => {
        this.centerMap(res);
      });

      // this.centerMap(geoFindMe.geoMarker);
    },
    fetchData() {
      axios.get("/api/refuges").then(response => {
        this.refuges = response.data.refuge;
      });
    },

    centerMap(geoMarker) {
      this.center = geoMarker;
      //console.log(geoMarker);
    },
    OnClickRefuge(index, geoMarker) {
      this.selectRefuge(index);
      this.centerMap(geoMarker);
      this.drawerRight = true;
    },
    selectRefuge(index) {
      this.openSider("refuge");
      this.refugeSelected = this.refuges[index];
      console.log(this.refuges[index]);
    },

    OnClickMyMap() {
      this.fetchMyRefuges();
    },
    fetchMyRefuges() {
      axios.get("/api/maps/1").then(response => {
        this.refuges = response.data.refuges;
      });
    },
    OnClickPosition(event) {
      if (!this.mode.addRefuge) {
        return null;
      }
      this.openSider("newRefuge");
      this.newGeoMarker = [event.latlng.lat, event.latlng.lng];
      this.centerMap(this.newGeoMarker);
      this.mode.addRefuge = false;
      this.drawerRight = true;
      let refuge = {};
      refuge.geoMarker = this.newGeoMarker;
      this.refuges.push(refuge);
    },
    openSider(sider) {
      this.sider = sider;
      console.log(sider);
    },
    newRefuge() {
      this.openSider("newRefuge");
    },
    attachRefuge(event) {
      alert(event);
    },
    detachRefuge() {
      this.fetchMyRefuges();
    },
    optionsMyMap() {
      this.sider = "mapOptions";
    }
  }
};
</script>
<style lang="scss" scoped>
.map {
  // width: 100%;
  height: 100%;
  //background-color: grey;
}
.sider {
  //width: 40%;
  //height: 100%;
}
.map-wraper {
  //background-color: red;
  // width: 100%;
  // height: 100%;
  //display: grid;
  // gap: 1em;
  // grid-template-columns: 2fr 1fr;
}
.popUp {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>
