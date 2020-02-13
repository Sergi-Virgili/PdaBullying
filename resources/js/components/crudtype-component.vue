<template>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="createType">
      <createtype-component @new="addType"></createtype-component>
      </div>

      <div class="typelist">
        <div v-for="(type,index) in types" :key="index">
          <type-component
          :type="type"
          @delete="deleteType(index)"
          @update="updateType(index)"/>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  data() {
    return {
      types: [],
    };
  },
  mounted(){
    this.getData();
  },
  methods: {
    getData(){
      axios.get('/api/types').then((response) =>{
         this.types =  response.data.data;
         console.log(this.types);
      })
    },
    addType(type) {
      this.types.push(type);
    },
    deleteType(index) {
      this.types.splice(index, 1);
    },
    updateType(index, type) {
      console.log(index)
      this.types[index] = type
    }
  }
};
</script>