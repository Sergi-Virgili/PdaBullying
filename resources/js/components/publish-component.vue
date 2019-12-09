<template>
  <section class="publishTable row">
    <table class="table table-hover col-md-6">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Recurso</th>
          <th scope="col">Publico</th>
          <th scope="col">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="(refuge, index) in refuges"
          :key="index"
          v-bind:class="{'table-danger':!refuge.is_Public}"
        >
          <th scope="row">{{refuge.id}}</th>
          <td>{{refuge.name}}</td>
          <td>{{refuge.is_Public}}</td>
          <td>
            <button
              class="btn btn-success"
              v-if="!refuge.is_Public"
              @click="onClickPublish(index)"
            >Publicar</button>
            <button
              class="btn btn-danger"
              v-if="refuge.is_Public"
              @click="onClickHidde(index)"
            >Ocultar</button>
          </td>
        </tr>
      </tbody>
    </table>
    <publicMap-component class="col-md-6" :refuges="refuges"></publicMap-component>
  </section>
</template>

<script>
export default {
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
    }
  }
};
</script>

<style>
</style>