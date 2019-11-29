<template>
    <div>
        <l-map class="map" :zoom="zoom" :min-zoom="3" :center="center">
            <l-tile-layer :url="url" />
            <l-marker :lat-lng="geoMarker">
                <l-popup>Hello!</l-popup>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
import { LMap, LTileLayer, LMarker, LPopup } from "vue2-leaflet";

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
            markers: [],
            geoMarker: [41.3876768, 2.169259]
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
