<template>
<v-flex height="100%">
<v-card >
    <v-card-title class="">
      <img :src="refugeSelected.logoUrl" />
       <p class="title" align="left">{{ refugeSelected.name }}</p>
    </v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <v-form>
        
       
        
        <v-list>
            <v-list-item>
            <v-list-item-action>
            <v-icon>mdi-email-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
            <v-list-item-title>email2email</v-list-item-title>
            </v-list-item-content>
            </v-list-item>
            <v-list-item>
            <v-list-item-action>
            <v-icon>mdi-phone-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
            <v-list-item-title>655 55 45 45</v-list-item-title>
            </v-list-item-content>
            </v-list-item>
        </v-list>

        <v-text-field disabled label="Email" prepend-icon="mdi-email-outline" />
        <v-text-field label="Teléfono" prepend-icon="mdi-phone-outline" />
        <i>mdi-map-web-outline</i><p>asdfa</p>

      </v-form>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions >
      <v-btn class="rounded" 
        @click="editMode = !editMode"
        v-if="!editMode" 
        tile 
        outlined 
        color="success">
        <span>Ver</span>
      </v-btn>
      <v-btn class="rounded" 
        @click="OnClickAttachRefuge"
       
        tile 
        outlined 
        color="success">
        <span>Import</span>
      </v-btn>
      <v-btn class="rounded" 
        @click="OnClickDetachRefuge"
        
        
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
  </v-flex>
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

<style lang="scss" scoped>
    .title {
        color: orange
    }
</style>>
