<template>
  <section class="publishTable row">
    <table class="table table-hover col-md-6">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Recurso</th>
          <th scope="col">Fecha</th>
          <th scope="col">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(refuge, index) in refuges"
          :key="index"
          
        >
          <th scope="row">{{refuge.id}}</th>
          <td>{{refuge.name}}</td>
          <td>{{refuge.created_at}}</td>
          <td>
            <v-btn
              class="rounded"
              tile
              outlined
              color="success"
              v-if="!refuge.is_Public"
              @click="onClickPublish(index)"
              x-small
            >Publicar</v-btn>
            <v-btn
              class="rounded"
              tile
              outlined
              color="blue"
              v-if="refuge.is_Public"
              @click="onClickHidde(index)"
              x-small
            >Ocultar</v-btn>

            <v-btn
              class="rounded"
              tile
              outlined
              color="grey"
              dark
              @click="openDialogRefuge"
              x-small
            >Ver</v-btn>

            <v-btn class="ma-2" outlined fab color="grey" @click="onClickDelete()" x-small>
              <v-icon>fa-trash</v-icon>
            </v-btn>
          </td>
        </tr>
      </tbody>
    </table>
    <publicMap-component class="col-md-6" :refuges="refuges"></publicMap-component>
  </section>
</template>

<script>
export default {
  name: "Publish",
  data() {
    return {
      refuges: []
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      axios.get("/api/refuges").then(response => {
        this.refuges = response.data.refuge;
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
      alert("Estas seguro que quieres eliminar DEFINITIVAMENTE ");
      axios.delete(`/api/refuges/${this.refuges[index].id}`).then(response => {
        this.refuges.splice(index, 1);
      });
    }
  }
};
</script>
