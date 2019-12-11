<template>
    <div>
        <div class="map-wraper">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" @click="fetchData">
                        PDA mapa
                    </button>
                    <button class="btn btn-success" @click="OnClickMyMap">
                        Mi mapa
                    </button>
                    <button class="btn btn-success" @click="newRefuge">
                        + Add Place
                    </button>
                    <button class="btn btn-success" @click="optionsMyMap">
                        Map Options
                    </button>
                    <button class="btn btn-success" @click="geo">Geo</button>
                </div>
                <div class="card-body">
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
                </div>
            </div>
            <section class="sider" v-if="sider">
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
                    v-if="sider == 'mapOptions'"
                    class="refugeSider"
                ></mapOptions-component>
            </section>
        </div>
        <refugeList-component
            :refuges="refuges"
            @selectRefuge="test(index)"
        ></refugeList-component>
    </div>
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";
import axios from "axios";
import geoFindMe from "../services/geolocationService";

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
            sider: ""
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        geo() {
            geoFindMe.findMe().then(res => {
                console.log(res);
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
        },
        selectRefuge(index) {
            this.openSider("refuge");
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
        },
        OnClickPosition(event) {
            this.openSider("newRefuge");
            this.newGeoMarker = [event.latlng.lat, event.latlng.lng];
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
    //width: 100%;
    height: 400px;
    //background-color: grey;
}
.sider {
    //width: 40%;
    height: 100%;
}
.map-wraper {
    //background-color: red;
    width: 100%;
    display: grid;
    gap: 1em;
    grid-template-columns: 2fr 1fr;
}
.popUp {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
</style>
