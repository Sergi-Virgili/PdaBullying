<template>
    <v-card >
    <v-card-title class="pb-0">
      <img :src="refugeSelected.logoUrl" />
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Título" v-if="editMode" v-model="refugeSelected.name"/>
        <v-text v-if="!editMode">{{ refugeSelected.name }}</v-text>
        
        
        <v-textarea
       v-if="editMode"
        v-model="refugeSelected.description"
        label="Descripción"
        rows="1"
        
        ></v-textarea>
        <p v-if="!editMode">{{ refugeSelected.description }}</p>
          
     
        <v-text-field v-if="!editMode" disabled label="Email" prepend-icon="mdi-email-outline" />
        <v-text-field v-if="editMode" label="Email" prepend-icon="mdi-email-outline" />
        <v-text-field v-if="!editMode" disabled label="Teléfono" prepend-icon="mdi-phone-outline" />
        <v-text-field v-if="editMode" label="Teléfono" prepend-icon="mdi-phone-outline" />
        <v-text-field v-if="!editMode" disabled label="Calle" prepend-icon="mdi-map-marker-outline" />
        <v-text-field v-if="editMode" label="Calle" prepend-icon="mdi-map-marker-outline" />
        <v-text-field v-if="!editMode" disabled label="Numero" prepend-icon="mdi-home-map-marker" />
        <v-text-field v-if="editMode" label="Numero" prepend-icon="mdi-home-map-marker" />
        <v-text-field v-if="!editMode" disabled label="Ciudad" prepend-icon="mdi-map-outline" />
        <v-text-field v-if="editMode" label="Ciudad" prepend-icon="mdi-map-outline" />

    
        <!-- <v-text-field
          :type="showPassword ? 'text' : 'password'"
          label="Confirma Password"
          prepend-icon="mdi-lock-outline"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"
        /> -->
      </v-form>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn class="rounded" 
        @click="editMode = !editMode"
        v-if="!editMode" 
        tile 
        outlined 
        color="success">
        <span>Edit</span>
      </v-btn>
      <v-btn class="rounded" 
        
        v-if="!editMode" 
        tile 
        outlined 
        color="success">
        <span>Import</span>
      </v-btn>
      <v-btn class="rounded" 
        
        v-if="!editMode" 
        tile 
        outlined 
        color="success">
        <span>Remove</span>
      </v-btn>
      <v-btn class="rounded" 
        
        v-if="!editMode" tile outlined 
        color="error">
        <span>Delete</span>
      </v-btn>
      <v-btn class="rounded" 
        @click="editMode = !editMode"
        
        v-if="editMode" 
        tile 
        outlined 
        color="primary">
        <span>Cancel</span>
      </v-btn>
      <v-btn class="rounded" 
        v-if="editMode" tile outlined 
        color="success">
        <span>Ok</span>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  // props: ["refuge"],
  data() {
    return {
      refugeSelected: {},
      editMode: false,
      
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get('/api/refuges/1').then(response => {
        this.refugeSelected = response.data;
      });
    },
    OnClickEdit(){
      this.editMode = true
      this.$emit("edit")
    },
    OnClickUpdate() {
      const params = {
        name: this.refugeSelected.name,
        description: this.refugeSelected.description,
        road: this.refugeSelected.road,
        hpuse_number: this.refugeSelected.house_number,
        city: this.refugeSelected.city,
        email: this.refugeSelected.email,
      };
      console.log(params)
      axios.put(`/api/refuges/${this.refuge.id}`, params).then((response) => {
      this.editMode = false;
      console.log(params);
      const refuge = response.data;
      this.$emit('update', refuge);
      });
    },
    OnClickAttachRefuge() {
      axios.get(`/api/maps/attach/${this.refugeSelected.id}`);
      //this.$emit("attachRefuge", this.refugeSelected.id);
    },
    OnClickDetachRefuge() {
      axios.get(`/api/maps/detach/${this.refugeSelected.id}`).then(response => {
        this.$emit("detachRefuge", this.refugeSelected.id);
      });
    }
  }
};
</script>

<style>
h3 {
  color: orange;
  padding: 1%;
}
.logo {
  width: 120px;
}
</style>