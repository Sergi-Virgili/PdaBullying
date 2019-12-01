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
        <svg
            id="contact_icon_01"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            width="142"
            height="127"
            viewBox="0 0 142 127"
        >
            <g id="Group_2" data-name="Group 2">
                <path
                    id="Clip_13-2"
                    data-name="Clip 13"
                    d="M59.059,0C38.868.024,19.614,3.378,9.29,16.285h0C3,24.141.016,35.518,0,47.84H0v.185a86.392,86.392,0,0,0,12.837,44.8h0c15.178,23.923,43.185,36.765,64.551,32.771h0c21.366-3.951,36.131-24.739,47.845-46.6h0c8.724-16.224,15.744-33.062,15.767-46.2h0v-.127a24.969,24.969,0,0,0-2.733-12.045h0C130.884,7.093,107.456,3.013,80.522.951h0C73.627.412,66.507.008,59.491,0h0"
                    transform="translate(1)"
                    fill="#C5D700"
                ></path>
            </g>
        </svg>
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
