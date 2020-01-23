<template>
  <section>
    <h2>Tu propio Mapa en un Iframe</h2>
    <iframe-component class="map"></iframe-component>
    <div class="code">
      <v-card>
        <v-card-text>
          <code>&lt;code&gt;</code>
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
