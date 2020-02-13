<template>
<div>
  
    <h4>Filtrar</h4>
    <v-form action class="contenedor">

      <div v-for="type in types" :key="type.id" id="typeList">
        <div class="form-check">
         
            <v-checkbox
              :label="type.name" 
              color="orange" 
              :value="type.id"
              hide-details
            ></v-checkbox>
       
          
        </div>
      </div>
    </v-form>
</div>
</template>

<script>
export default {
  data() {
    return {      
      types: []
    };
  },
  mounted() {

    this.fetchTypeData();
    
  },
  methods: {
   
    fetchTypeData() {
      axios.get("/api/types").then(response => {
        this.types = response.data.data;
       
      });
    },
  }
};
</script>

<style>
h4 {
  color: orange;
  padding: 2%;
  text-align: center;
  margin-top: 20px;
}
#typeList{
    display: grid;
    justify-items: left;
    grid-column: 2/3;
}
input{
    color: orange
}
.contenedor{
  margin-top: 20px;
  margin-bottom: 20px;
  display: grid;
  width: 100%;
}
.btn.btn.btn-success {
  margin-left: 2%;
  color: white;
}
.v-card {
  height: 100%;
}
</style>