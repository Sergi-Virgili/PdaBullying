<template>
<div>
  
  <v-card>
    <h4>Nuevo Recurso</h4>
    <v-form action>
      <v-text-field label="Name" required v-model="refuge.name"/>
      <v-text-field label="Descripción" v-model="refuge.description"/>
      <div v-for="type in types" :key="type.id">
        <div >
          <v-checkbox
            multiple
            :label="type.name"
           
            :value="type.id"
            v-model ="refuge.checkedTypes"
          ></v-checkbox>
         
        </div>
      </div>
      <span>Checked names: {{ refuge.checkedTypes }}</span>
      <v-text-field label="Email" prepend-icon="mdi-email-outline" v-model="refuge.email" />
      <v-text-field label="Teléfono" prepend-icon="mdi-phone-outline" v-model="refuge.phone" />
      <v-text-field
        label="Comunitat Autónoma"
        prepend-icon="mdi-map-marker-outline"
        :value="refuge.state"
      />
      <v-text-field label="País" prepend-icon="mdi-map-marker-outline" v-model="refuge.country" />
      

      <v-text-field label="Carrer" prepend-icon="mdi-map-marker-outline" v-model="refuge.road" />
      <v-text-field
        label="Nombre del Carrer"
        prepend-icon="mdi-map-marker-outline"
        :value="refuge.house_number"
      />
      <v-text-field label="Ciutat" prepend-icon="mdi-map-marker-outline" v-model="refuge.city" />
      <v-text-field label="CP" prepend-icon="mdi-map-marker-outline" v-model="refuge.postcode" />
      
    </v-form>
    <button class="btn btn-success" @click="saveNewRefuge">OK</button>
  </v-card>
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
        postcode: "",
        state: "",
        country: "",
        name: "",
        description: "",
        email: "",
        phone: "",
        checkedTypes: []
      },
      
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
         
          this.refuge = response.data.address;
          this.lat = response.data.lat;
          this.lng = response.data.lon;
        });
    },
    fetchTypeData() {
      axios.get("/api/types").then(response => {
        this.types = response.data.data;
        
      });
    },
    saveNewRefuge() {
      let formData = {
        name: this.refuge.name,
        description: this.refuge.description,
        lat: this.lat,
        lng: this.lng,
        road: this.refuge.road,
        city: this.refuge.city,
        postcode: this.refuge.postcode,
        house_number: this.refuge.house_number,
        country: this.refuge.country,
        state: this.refuge.state,
        email: this.refuge.email,
        phone: this.refuge.phone,
        types: this.refuge.checkedTypes
      };
      console.log(formData);
      axios
        .post("/api/refuges/", formData)
        .then(response => {
          
          this.refuge = {
            road: "",
            house_number: "",
            city: "",
            country: "",
            postcode: "",
            state: "",
            country: "",
            name: "",
            description: "",
            email: "",
            phone: "",
        };
        this.$emit('close');
      }
      );
    }
  }
};
</script>

<style>
h4 {
  color: orange;
  padding: 2%;
  text-align: center;
}
form {
  margin-left: 3%;
  margin-right: 3%;
  color: grey;
}
.btn.btn.btn-success {
  margin-left: 2%;
  color: white;
}
.v-card {
  height: 100%;
}
</style>