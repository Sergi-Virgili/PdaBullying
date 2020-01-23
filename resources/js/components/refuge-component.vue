<template>

<v-card >
    <v-card-title class="pb-0">
      <img :src="refugeSelected.logoUrl" />
    </v-card-title>
    <v-card-text>
      <v-form>
        
        <h4 COLOR="orange">{{ refugeSelected.name }}</h4>
        
        
          
     
        <v-text-field disabled label="Email" prepend-icon="mdi-email-outline" />
        <v-text-field label="Teléfono" prepend-icon="mdi-phone-outline" />
        <v-text-field label="Web" prepend-icon="mdi-map-web-outline" />
       

    
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
        @click="OnClickDetachRefuge"
       
        tile 
        outlined 
        color="success">
        <span>Import</span>
      </v-btn>
      <v-btn class="rounded" 
        
        
        tile 
        outlined 
        color="success">
        <span>Remove</span>
      </v-btn>
      <v-btn class="rounded" 
        
         tile outlined 
        color="error">
        <span>Delete</span>
      </v-btn>
      
    </v-card-actions>
  </v-card>
    <!-- <div class="card">
        <div class="card-header">
            <img v-if="refugeSelected" :src="refugeSelected.logoUrl" />
            <h3 v-if="refugeSelected">{{ refugeSelected.name }}</h3>
            <p v-if="refugeSelected">{{ refugeSelected.description }}</p>
        </div>
        <div class="card-footer">
            <button @click="OnClickAttachRefuge" class="btn btn-success">
                Al Meu Mapa
            </button>
            <button @click="OnClickDetachRefuge" class="btn btn-danger">
                Fora del Meu Mapa
            </button>
        </div>
    </div> -->
</template>

<script>
export default {
    props: ["refugeSelected"],
    methods: {
        OnClickAttachRefuge() {
            axios.get(`/api/maps/attach/${this.refugeSelected.id}`);
            //this.$emit("attachRefuge", this.refugeSelected.id);
        },
        OnClickDetachRefuge() {
            axios
                .get(`/api/maps/detach/${this.refugeSelected.id}`)
                .then(response => {
                    this.$emit("detachRefuge", this.refugeSelected.id);
                });
        }
    }
};
</script>

<style></style>
