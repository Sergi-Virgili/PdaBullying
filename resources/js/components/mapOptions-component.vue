<template>
    <section class="card mapOptions">
        <header class="card-header">Opciones de Mi Mapa</header>
        <main class="card-body">
            <!-- <label for="mapCenter"></label> -->
            <button class="btn btn-success">Mapa actual</button>
            <p>Centro: {{ myMapCenter }}</p>
            <p>zoom: {{ myMapZoom }}</p>
            <button class="btn btn-success" @click="updateMyMapProperties">
                Actualizar
            </button>
            <p>Centro: {{ newCenter }}</p>
            <p>zoom: {{ newZoom }}</p>
            <p>Posiciona el mapa y el zoom para actualizar tu mapa público</p>
        </main>
    </section>
</template>

<script>
export default {
    props: ["newCenter", "myMapCenter", "myMapZoom", "newZoom"],
    methods: {
        updateMyMapProperties() {
            //TODO FAKET MAP ID
            let data = {
                zoom: this.newZoom,
                center: this.newCenter
            }
            axios.patch('/api/maps/1', data).then(response => {
                console.log(response)
            })
        }
    }
};
</script>

<style></style>
