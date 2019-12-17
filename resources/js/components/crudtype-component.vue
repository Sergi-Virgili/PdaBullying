<template>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <createtype-component @new="addType"></createtype-component>
      <type-component
        v-for="(type, index) in types"
        :key="type.id"
        :type="type"
        @delete="deleteType(index)"
      ></type-component>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      types: [
        {
          id: 1,
          name: "pinches perros"
        }
      ]
    };
  },
  mounted() {
    console.log("component mounted.");
  },
  methods: {
    addType(type) {
      this.types.push(type);
    },
    deleteType(index) {
      this.types.splice(index, 1);
    }
  }
};
</script>