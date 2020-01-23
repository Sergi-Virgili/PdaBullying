<template>
  <section>
    <h2>Tu propio Mapa en un Iframe</h2>
    
    <div class="code">
      <v-card>
        <v-card-text>
          <cite>
            &lt;iframe&gt;
            &lt;/iframe&gt;
            </cite>
          <v-divider></v-divider>
          <iframe-component class="map"></iframe-component>
        </v-card-text>
      </v-card>
    </div>
  </section>
</template>

<script>
export default {
  name: "MyCode"
};
</script>

<style>
.map {
  height: 100px;
}
</style>
