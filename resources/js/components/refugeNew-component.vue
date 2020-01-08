<template>
  <div class="card">
    <div class="card-header">Nova Localització</div>
    <div class="card-body">
      <label for="image">Logo</label>
      <input class="form-control" type="file" @change="upload" name="image" id="image" />

      <label for="name">Nom</label>
      <input class="form-control" type="text" name="name" id="name" v-model="name" />
      <label for="description">Description</label>
      <textarea
        class="form-control"
        type="text"
        name="description"
        id="description"
        v-model="description"
      ></textarea>
      <div v-for="type in types" :key="type.index">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="exampleRadios" id="exampleRadios1" />
          <label class="form-check-label" for="exampleRadios1">{{ type.name }}</label>
        </div>
      </div>
      <p>Dirección</p>
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
        <p>geoposition: {{ lat }} {{ lng }}</p>
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
      img: "",
      lat: "",
      lng: "",
      refuge: {
        road: "",
        house_number: "",
        city: "",
        country: "",
        postcode: "",
        state: "",
        country: ""
      },
      name: "",
      description: "",
      types: []
    };
  },
  mounted() {
    this.lat = this.newGeoMarker[0];
    this.lng = this.newGeoMarker[1];

    this.fetchLocationData();
    this.fetchTypeData();
  },
  methods: {
    fetchLocationData() {
      axios
        .get(
          `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${this.lat}&lon=${this.lng}&zoom=18`
        )
        .then(response => {
          console.log(response.data);
          this.refuge = response.data.address;
          this.lat = response.data.lat;
          this.lng = response.data.lon;
        });
    },
    fetchTypeData() {
      axios.get("/api/types").then(response => {
        this.types = response.data.data;
        console.log(response.data.data);
      });
    },
    upload(event) {
      console.log(event.target.files[0].name);
      this.img = event.target.files[0];
      let readerImg = new FileReader();
      readerImg.readAsDataURL(this.img);
      //   readerImg.onload = event => {
      //     console.log(event.target.result);
      //     this.img = event.target;
      //   };
    },
    saveNewRefuge() {
      let formData = new FormData();
      formData.append("img", this.img);
      let config = {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      };

      //   let formData1 = {
      //     name: this.name,
      //     description: this.description,
      //     lat: this.lat,
      //     lng: this.lng,
      //     road: this.refuge.road,
      //     city: this.refuge.city,
      //     postcode: this.refuge.postcode,
      //     house_number: this.refuge.house_number,
      //     country: this.refuge.country,
      //     state: this.refuge.state,
      //     img: this.img
      //   };

      axios
        .post("/api/refuges/", formData, config)
        .then(response => console.log(response));
    }
  }
};
</script>

<style></style>
