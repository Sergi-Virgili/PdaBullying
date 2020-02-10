<template>
    <div>
        
        <v-card >
            <v-card-title class="pb-0">
                <img :src="refugeSelected.logoUrl" />
            </v-card-title>
            
            
            <v-card-text>
                <v-form>
                    <v-text-field
                        label="Título"
                        v-if="editMode"
                        v-model="refugeSelected.name"
                    />
                    <p v-if="!editMode">{{ refugeSelected.name }}</p>

                    <v-textarea
                        v-if="editMode"
                        v-model="refugeSelected.description"
                        label="Descripción"
                        rows="1"
                        auto-grow
                    ></v-textarea>
                    <p v-if="!editMode">{{ refugeSelected.description }}</p>

                    <v-text-field
                        v-if="!editMode"
                        disabled
                        label="Email"
                        prepend-icon="mdi-email-outline"
                        v-model="refugeSelected.email"
                    />
                    <v-text-field
                        v-if="editMode"
                        label="Email"
                        prepend-icon="mdi-email-outline"
                        v-model="refugeSelected.email"
                    />
                    <v-text-field
                        v-if="!editMode"
                        disabled
                        label="Teléfono"
                        prepend-icon="mdi-phone-outline"
                        v-model="refugeSelected.phone"
                    />
                    <v-text-field
                        v-if="editMode"
                        label="Teléfono"
                        prepend-icon="mdi-phone-outline"
                        v-model="refugeSelected.phone"
                    />
                    <v-text-field
                        v-if="!editMode"
                        disabled
                        label="Calle"
                        prepend-icon="mdi-map-marker-outline"
                        v-model="refugeSelected.road"
                    />
                    <v-text-field
                        v-if="editMode"
                        label="Calle"
                        prepend-icon="mdi-map-marker-outline"
                        v-model="refugeSelected.road"
                    />
                    <v-text-field
                        v-if="!editMode"
                        disabled
                        label="Numero"
                        prepend-icon="mdi-home-map-marker"
                        v-model="refugeSelected.house_number"
                    />
                    <v-text-field
                        v-if="editMode"
                        label="Numero"
                        prepend-icon="mdi-home-map-marker"
                        v-model="refugeSelected.house_number"
                    />
                    <v-text-field
                        v-if="!editMode"
                        disabled
                        label="Ciudad"
                        prepend-icon="mdi-map-outline"
                        v-model="refugeSelected.city"
                    />
                    <v-text-field
                        v-if="editMode"
                        label="Ciudad"
                        prepend-icon="mdi-map-outline"
                        v-model="refugeSelected.city"
                    />

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
            <v-card-actions v-if="currentUser">
                
                <v-btn
                    class="rounded"
                    v-if="!editMode"
                    tile
                    outlined
                    color="success"
                    @click="attachRefuge"
                >
                    <span>Import</span>
                </v-btn>
                <v-btn
                    class="rounded"
                    v-if="!editMode"
                    tile
                    outlined
                    color="success"
                    @click="detachRefuge"
                >
                    <span>Remove</span>
                </v-btn>
                <template v-if="isEditable">
                    <v-btn
                    class="rounded"
                    @click="editMode = !editMode"
                    v-if="!editMode"
                    tile
                    outlined
                    color="success"
                >
                    <span>Edit</span>
                </v-btn>
                <v-btn
                    class="rounded"
                    @click="OnClickDelete()"
                    v-if="!editMode"
                    tile
                    outlined
                    color="error"
                >
                    <span>Delete</span>
                </v-btn>
                <v-btn
                    class="rounded"
                    @click="editMode = !editMode"
                    v-if="editMode"
                    tile
                    outlined
                    color="primary"
                >
                    <span>Cancel</span>
                </v-btn>
                <v-btn
                    class="rounded"
                    v-if="editMode"
                    tile
                    outlined
                    @click="OnClickUpdate()"
                    color="success"
                >
                    <span>Ok</span>
                </v-btn>
                </template>
            </v-card-actions>
        </v-card>
    </div>
</template>

<script>
export default {
    props: ["refugeSelected"],
    data() {
        return {
            //refugeSelected: {},
            editMode: false
        };
    },
    mounted: {
        
    },
    methods: {

        attachRefuge() {
            axios
                .get(`/api/maps/attach/${this.refugeSelected.id}`)
                .then(response => console.log("attached"));
            //this.$emit("attachRefuge", this.refugeSelected.id);
        },
        OnClickEdit() {
            this.editMode = true;
        },
        OnClickDelete() {
            axios.delete(`/api/refuges/${this.refuge.id}`).then(() => {
                this.editMode = false;
                // this.$emit("delete")
            });
        },
        OnClickUpdate() {
            const params = {
                name: this.refugeSelected.name,
                description: this.refugeSelected.description,
                road: this.refugeSelected.road,
                hpuse_number: this.refugeSelected.house_number,
                city: this.refugeSelected.city,
                email: this.refugeSelected.email,
                phone: this.refugeSelected.phone
            };
           
            axios
                .put(`/api/refuges/${this.refugeSelected.id}`, params)
                .then(response => {
                    this.editMode = false;
                    const refuge = response.data;
                    console.log(response.data);
                    this.$emit("update", refuge);
                });
        },

        detachRefuge() {
            axios
                .get(`/api/maps/detach/${this.refugeSelected.id}`)
                .then(response => {
                    this.$emit("detachRefuge", this.refugeSelected.id);
                });
        }
    },
    computed: {
        currentUser() {
            return this.$store.state.currentUser;
        },
        isEditable() {
            if (this.currentUser.id === this.refugeSelected.user_id) {
                return true;
            }
            return false
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
