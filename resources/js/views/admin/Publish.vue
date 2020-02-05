<template>
    <section class="publishTable row">
        <table class="table table-hover col-md-6">
            <thead>
                <tr>
                    <th scope="col">Recurso</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(refuge, index) in refugesList.data.data" :key="index">
                    <v-dialog v-model="dialog" width="600px" style="z-index:10">
                        <refugeModal-component
                            :refugeSelected="refuge"
                            @update="updateRefuge(index, ...arguments)"
                        ></refugeModal-component>
                    </v-dialog>
                    <td>{{ refuge.name }}</td>
                    <td>{{ refuge.created_at }}</td>
                    <td>
                        <v-tooltip top v-if="!refuge.is_Public">
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    v-on="on"
                                    class="ma-2"
                                    fab
                                    color="success"
                                    dark
                                    @click="onClickPublish(index)"
                                    x-small
                                >
                                    <v-icon>mdi-publish</v-icon>
                                </v-btn>
                            </template>
                            <span>Publicar</span>
                        </v-tooltip>

                        <v-tooltip top v-if="refuge.is_Public">
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    class="ma-2"
                                    fab
                                    v-on="on"
                                    color="blue darken-2"
                                    dark
                                    @click="onClickHidde(index)"
                                    x-small
                                >
                                    <v-icon>mdi-eye-off</v-icon>
                                </v-btn>
                            </template>
                            <span>Ocultar</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    class="ma-2"
                                    v-on="on"
                                    fab
                                    color="orange darken-2"
                                    dark
                                    @click="openDialogRefuge"
                                    x-small
                                >
                                    <v-icon>mdi-information</v-icon>
                                </v-btn>
                            </template>
                            <span>Información</span>
                        </v-tooltip>

                        <v-tooltip top>
                            <template v-slot:activator="{ on }">
                                <v-btn
                                    class="ma-2"
                                    v-on="on"
                                    fab
                                    color="red"
                                    dark
                                    @click="onClickDelete(index)"
                                    x-small
                                >
                                    <v-icon>mdi-trash-can-outline</v-icon>
                                </v-btn>
                            </template>
                            <span>Eliminar</span>
                        </v-tooltip>
                    </td>
                </tr>
                <v-pagination
                    v-model="refugesList.pagination.current_page"
                    :circle="circle"
                    :disabled="disabled"
                    :length="length"
                    :next-icon="nextIcon"
                    :prev-icon="prevIcon"
                    :page="refugesList.pagination.current_page"
                    :total-visible="totalVisible"
                    @input="changePage()"
                    >
                </v-pagination>
            </tbody>
        </table>

        <publicMap-component
            style="z-index: 1"
            class="col-md-6"
            :refuges="refuges"
        ></publicMap-component>
    </section>
</template>

// TODO: refactor and clean the code

<script>
export default {
    name: "Publish",
    data() {
        return {
            refuges: [],
            refugesList: [],
            dialog: false,
            circle: true,
            disabled: false,
            length: "",
            nextIcon: 'mdi-chevron-right',
            prevIcon: 'mdi-chevron-left',
            totalVisible: 3,   
        };
    },
    created() {
        this.fetchData();
        this.getPaginatedItems(this.refugesList.pagination.current_page);
        this.PaginationLength(refuges);
    },
    methods: {
        fetchData() {
            axios.get("/api/refuges").then(response => {
                this.refuges = response.data.refuge;
                this.refugesList = response.data.response;
                console.log(this.refugesList);
            });
        },
        getPaginatedItems(page) {
            axios.get(`/api/refuges?page=${page}`).then(response => {
                this.refuges = response.data.refuge;
                this.refugesList = response.data.response;
            });
        },
        onClickPublish(index) {
            let data = { id: this.refuges[index].id };
            axios.patch("/api/refuges/publish", data).then(response => {
                console.log(response);
                this.refuges[index].is_Public = 1;
            });
        },
        onClickHidde(index) {
            let data = { id: this.refuges[index].id };
            axios.patch("/api/refuges/hidde", data).then(response => {
                this.refuges[index].is_Public = 0;
            });
        },
        onClickDelete(index) {
            axios
                .delete(`/api/refuges/${this.refuges[index].id}`)
                .then(response => {
                    this.refuges.splice(index, 1);
                    this.refugesList.splice(index, 1);
                });
        },
        openDialogRefuge() {
            this.dialog = true;
        },
        changePage() {
            this.refugesList.pagination.current_page;
            this.getPaginatedItems(this.refugesList.pagination.current_page);
            console.log(this.refugesList.pagination.current_page);
        },
        PaginationLength(refuges) {
            length = refuges.length / 5
            if (isInteger(length)){
                return length + 1;
            }
            this.refugesList.pagination.total = length;
        }
    }
};
</script>
