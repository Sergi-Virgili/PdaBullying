<template>
  <v-app>
    <v-list dense>
      <v-list-item v-for="item in items" :key="item.id">
        <v-checkbox color="grey" height="1px"></v-checkbox>
        <span>{{item.name}}</span>
      </v-list-item>
    </v-list>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      items: []
    };
  },
  created() {
    this.fetchItem();
  },
  methods: {
    fetchItem() {
      axios.get("/api/types/").then(response => {
        this.items = response.data.data;
        console.log(response);
      });
    }
  }
};
</script>

<style>
h1 {
  background-color: black;
}
.types {
  height: 15px;
}
</style>