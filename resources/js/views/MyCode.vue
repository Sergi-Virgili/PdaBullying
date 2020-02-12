<template>
  <section>
    <h2>Tu propio Mapa en un Iframe</h2>
    
    <div class="code">
      <v-card>
        <v-card-text>
          <cite>
            &lt;iframe src="{{link}}"
      frameborder="0"
      height="500"
      width="800"&gt;
            
      
    
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
  name: "MyCode",
  data() {
    return {
      link: ''
    }
  },
  mounted() {
    this.linkFactory();
  },
  methods: {
    linkFactory() {
      this.link = 'http://127.0.0.1:8000/map/'+this.currentUser;
      
    }
  },

  computed: {
    currentUser() {
      return this.$store.getters.currentUser.id;
    }
  }
};
</script>

<style>
.map {
  height: 100px;
}
</style>
