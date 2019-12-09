<template>
  <div class="card">
    <div class="card-header">Nova Localització</div>
    <div class="card-body">
      <label for="name">Nom</label>
      <input class="form-control" type="text" name="name" id="name" v-model="name" />
      <label for="description">Description</label>
      <input
        class="form-control"
        type="text"
        name="description"
        id="description"
        v-model="description"
      />
      <label for="street">Carrer</label>
      <input class="form-control" type="text" name="street" id="street" :value="refuge.road" />
      <label for="number">Número</label>
      <input
        class="form-control"
        type="text"
        name="number"
        id="number"
        :value="refuge.house_number"
      />
      <label for="city">Ciutat</label>
      <input class="form-control" type="text" name="city" id="city" :value="refuge.city" />
      <label for="postcode">Codi Postal</label>
      <input
        class="form-control"
        type="text"
        name="postcode"
        id="postcode"
        :value="refuge.postcode"
      />
      <div>
        <p>geoposition: {{lat}} {{lng}}</p>
      </div>
      <button class="btn btn-success" @click="saveNewRefuge">OK</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["newGeoMarker"],
  data() {
    return {
      lat: "",
      lng: "",
      refuge: {
        road: "",
        house_number: "",
        city: "",
        country: "",
        postcode: ""
      },
      name: "",
      description: ""
    };
  },
  mounted() {
    this.lat = this.newGeoMarker[0];
    this.lng = this.newGeoMarker[1];

    this.fetchLocationData();
  },
  methods: {
    fetchLocationData() {
      axios
        .get(
          `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${this.lat}&lon=${this.lng}&zoom=18`
        )
        .then(response => {
          console.log(response.data.lat);
          this.refuge = response.data.address;
          this.lat = response.data.lat;
          this.lng = response.data.lon;
        });
    },
    saveNewRefuge() {
      let formData = {
        name: this.name,
        description: this.description,
        lat: this.lat,
        lng: this.lng
      };

      axios
        .post("/api/refuges/", formData)
        .then(response => console.log(response));
    }
  }
};
</script>

<style>
</style>
