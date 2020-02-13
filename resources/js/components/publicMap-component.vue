<template>
    <section class="publiMap">
        <l-map
            v-if="isLoaded"
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
                            <v-img
                                height="100px"
                                contain
                                :src="refuge.logoUrl"
                                alt
                            />
                            <h2>{{ refuge.name }}</h2>
                            <div class="email">
                                <v-icon small color="teal darken-2"
                                    >mdi-email</v-icon
                                >
                                <h3>{{ refuge.email }}</h3>
                            </div>
                            <div class="phone">
                                <v-icon small color="teal darken-2"
                                    >fa-phone</v-icon
                                >
                                <h3>{{ refuge.phone }}</h3>
                            </div>
                            <v-dialog
                                v-model="dialog"
                                width="600px"
                                style="z-index:10000"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-btn
                                        x-small
                                        color="teal darken-2"
                                        width="100%"
                                        v-on="on"
                                        dark
                                        @click="openDialogRefuge"
                                        >Ver</v-btn
                                    >
                                </template>
                                <refugeModal-component
                                    v-if="sider == 'refuge'"
                                    :refugeSelected="refugeSelected"
                                    style="z-index:100000"
                                ></refugeModal-component>
                            </v-dialog>
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
            isLoaded: true,
            icon: icon({
                iconUrl: "/img/icons8-marker-30.png",
                iconSize: [30, 30]
                //iconAnchor: [16, 37]
            }),
            dialog: false,
            sider: ""
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
        },
        openDialogRefuge() {
            this.openSider("refuge");
        },
        openSider(sider) {
            this.sider = sider;
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
    align-content: center;
}

.popUp h2 {
    font-size: 16px;
}

.popUp h3 {
    font-size: 13px;
    font-weight: bold;
    color: black;
    display: inline-block;
}

.button_list {
    width: 100%;
}
</style>
