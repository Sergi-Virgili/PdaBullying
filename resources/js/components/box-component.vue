<template>
  <v-app>
    <v-card fluid>
      <v-list dense>
        <v-checkbox color="grey" v-model="selected" label="Type1" value="Type1"></v-checkbox>
        <v-checkbox color="grey" v-model="selected" label="Type2" value="Type2"></v-checkbox>
        <v-checkbox color="grey" v-model="selected" label="Type3" value="Type3"></v-checkbox>
        <v-checkbox color="grey" v-model="selected" label="Type4" value="Type4"></v-checkbox>
      </v-list>
    </v-card>
  </v-app>
</template>



<script>
export default {
  data() {
    return {};
  }
};
</script>

<style>
h1 {
  background-color: black;
}
</style>