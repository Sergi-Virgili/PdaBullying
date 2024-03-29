<template>
    <div class="map-wraper">
        <v-navigation-drawer
            style="z-index:2"
            color="rgba(255, 255, 255, 1"
            floating
            permanent
            absolute
            :mini-variant="true"
            :mini-variant-width="50"
        >
            <toolsbar-component
                @addRefugeMode="addRefugeMode"
                @mapOptionsSave="updateMyMapProperties"
                @geo="geo"
            ></toolsbar-component>
        </v-navigation-drawer>

        <div>
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
                                <v-img
                                    :src="refuge.logoUrl"
                                    height="100px"
                                    contain
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
                                    v-model="dialog1"
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
                                        @update="
                                            updateRefuge(index, ...arguments)
                                        "
                                        style="z-index:100000"
                                        @detachRefuge="detachRefuge"
                                    ></refugeModal-component>
                                </v-dialog>
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
                        <v-col class="text-center">
                            <!-- <MainApp /> -->
                            <!-- <router-view @dialog="openDialog"></router-view> -->

                            <!-- <map-component class="map"></map-component> -->
                        </v-col>

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
                                        @update="
                                            updateRefuge(index, ...arguments)
                                        "
                                        @detachRefuge="detachRefuge"
                                        style="z-index:100000"
                                    ></refugeModal-component>
                                </v-dialog>
                            </div>
                        </l-popup>
                    </l-marker>
                </div>
            </l-map>
            <v-navigation-drawer v-model="drawerRight" right absolute temporary>
                <refugeNew-component
                    v-if="sider == 'newRefuge'"
                    :newGeoMarker="newGeoMarker"
                    @close="drawerRight = false"
                    class="refugeSider"
                ></refugeNew-component>
            </v-navigation-drawer>
        </div>
        <v-bottom-sheet v-model="mode.list" class="button_list">
            <template v-slot:activator="{ on }">
                <v-btn width="100%" v-on="on">
                    <i style="color:orange" class="fas fa-angle-down fa-2x"></i>
                </v-btn>
            </template>
            <v-content class="button_list" style="z-index:20000000">
                <v-card class="button_list">
                    <refugeList-component
                        :refuges="refuges"
                    ></refugeList-component>
                </v-card>
            </v-content>
        </v-bottom-sheet>
    </div>
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";
import axios from "axios";
import geoFindMe from "../services/geolocationService";
import { LatLng, icon } from "leaflet";

export default {
    name: "PublicMap",
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
                iconUrl: "/img/icons8-marker-30.png",
                iconSize: [30, 30]
                //iconAnchor: [16, 37]
            }),
            icon2: icon({
                iconUrl: "/img/icons8-marker-16.png",
                iconSize: [30, 30]
                //iconAnchor: [16, 37]
            }),
            drawerRight: false,
            mode: {
                list: false,
                addRefuge: false
            },
            dialog: false,
            dialog1: false
        };
    },
    created() {
        this.fetchMyRefuges();
        this.fetchMyMap();
    },
    methods: {
        openDialogRefuge() {
            this.openSider("refuge");
        },
        addRefugeMode() {
            //TODO CHANGE CURSOS IN MAP
            this.mode.addRefuge = true;
        },
        updateMyMapProperties() {
            //TODO FAKET MAP ID
            alert("El zoom y posición de tu mapa han sido modificados");
            let data = {
                zoom: this.zoom,
                center: this.center
            };
            axios.patch("/api/maps/1", data).then(response => {
                console.log(response);
            });
        },

        fetchMyMap() {
            axios.get("/api/maps/1").then(response => {
                this.center = response.data.center;
                this.zoom = response.data.zoom;
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
        },
        detachRefuge() {
            this.fetchMyRefuges();
        },
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
            // this.drawerRight = true;
        },

        updateRefuge(index, refuge) {
            this.refugeSelected[index] = refuge;
        },

        selectRefuge(index) {
            //this.openSider("refuge");
            this.refugeSelected = this.refuges[index];
            console.log(this.refuges[index]);
        },

        OnClickMyMap() {
            this.fetchMyRefuges();
        },

        fetchMyRefuges() {
            // TODO map user is faked
            axios.get("/api/maps/1").then(response => {
                this.refuges = response.data.refuges;
            });
        },
        OnClickPosition(event) {
            if (!this.mode.addRefuge) {
                return null;
            }
            this.mode.addRefuge = false;
            this.newGeoMarker = [event.latlng.lat, event.latlng.lng];
            let refuge = {};
            refuge.geoMarker = this.newGeoMarker;
            this.refuges.push(refuge);
            this.sider = "newRefuge";
            //this.dialog = true;
            this.centerMap(this.newGeoMarker);
            this.drawerRight = true;
        },
        openSider(sider) {
            this.sider = sider;
        },

        newRefuge() {
            this.openSider("newRefuge");
        },

        detachRefuge() {
            this.fetchMyRefuges();
        }
        // optionsMyMap() {
        //   this.sider = "mapOptions";
        // }
    }
};
</script>
<style lang="scss" scoped>
.typeBox {
    position: relative;
}
.map {
    width: 100%;
    height: 100%;
}
.leaflet-container {
    height: 100%;
}

.map-wraper {
    height: 100%;
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
