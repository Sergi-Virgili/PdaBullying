<template>
    <v-card>
        <h4>Nova Localització</h4>
        <form action="">
            <label for="name">Nom</label>
            <input
                class="form-control"
                type="text"
                name="name"
                id="name"
                v-model="name"
            />
            <label for="description">Descripció</label>
            <input
                class="form-control"
                type="text"
                name="descripció"
                id="description"
                v-model="description"
            />
            <label for="email">Email</label>
            <input
                class="form-control"
                type="text"
                name="email"
                id="email"
                v-model="email"
            />
            <label for="telefono">Telefono</label>
            <input
                class="form-control"
                type="text"
                name="phone"
                id="phone"
                v-model="phone"
            />
            <label for="comunitat">Comunitat Autónoma</label>
            <input
                class="form-control"
                type="text"
                name="state"
                id="state"
                v-model="state"
            />
            <label for="country">País</label>
            <input
                class="form-control"
                type="text"
                name="country"
                id="country"
                v-model="pais"
            />
            <div v-for="type in types" :key="type.id">
                <div class="form-check">
                    <input
                        class="form-check-input"
                        type="checkbox"
                        :name="type.name"
                        :id="type.id"
                        :value="type.id"
                    />
                    <label class="form-check-label" :for="type.name">
                        {{ type.name }}
                    </label>
                </div>
            </div>

            <label for="street">Carrer</label>
            <input
                class="form-control"
                type="text"
                name="street"
                id="street"
                :value="refuge.road"
            />
            <label for="number">Número</label>
            <input
                class="form-control"
                type="text"
                name="number"
                id="number"
                :value="refuge.house_number"
            />
            <label for="city">Ciutat</label>
            <input
                class="form-control"
                type="text"
                name="city"
                id="city"
                :value="refuge.city"
            />
            <label for="postcode">Codi Postal</label>
            <input
                class="form-control"
                type="text"
                name="postcode"
                id="postcode"
                :value="refuge.postcode"
            />
            <label for="geoposition">
                <p>Geoposició: {{ lat }} {{ lng }}</p></label
            >
        </form>
        <button class="btn btn-success" @click="saveNewRefuge">OK</button>
    </v-card>
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
        saveNewRefuge() {
            let formData = {
                name: this.name,
                description: this.description,
                lat: this.lat,
                lng: this.lng,
                email: this.refuge.email,
                phone: this.refuge.phone,
                road: this.refuge.road,
                city: this.refuge.city,
                postcode: this.refuge.postcode,
                house_number: this.refuge.house_number,
                country: this.refuge.country,
                state: this.refuge.state,
                type: this.refuge.type
            };

            axios
                .post("/api/refuges/", formData)
                .then(response => console.log(response));
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
