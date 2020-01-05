<template>
    <section class="map-wrapper">
        <publicMap-component
        v-if="loaded"
            class="map"
            :refuges="refuges"
            :center ="center"
            :zoom ="zoom"
        ></publicMap-component>
    </section>
</template>

<script>
export default {
    data() {
        return {
            refuges: [],
            center: "",
            zoom: "",
            loaded: false
        };
    },
    created() {
        this.fetchMyRefuges();
    },
    methods: {
        fetchMyRefuges() {
            axios.get("/api/maps/1").then(response => {
                this.refuges = response.data.refuges;
                this.center = response.data.center;
                this.zoom = response.data.zoom;
                this.loaded = true
            });
        }
    }
};
</script>

<style lang="scss" scoped>
.map {
    height: 100vh;
    width: 100%;
}
.map-wrapper {
    height: 100vh;
    width: 100%;
}</style
>>
