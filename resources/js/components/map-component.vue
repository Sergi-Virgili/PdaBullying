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
                v-for="resource in resources"
                :key="resource.index"
                :lat-lng="resource.geoMarker"
                @click="centerMap(resource.geoMarker)"
            >
                <l-popup>{{ resource.name }}</l-popup>
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
            resources: []
        };
    },
    mounted() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            axios.get("/api/v1/resources").then(response => {
                this.resources = response.data.resources;
                console.log(this.resources);
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
