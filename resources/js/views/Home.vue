<template>
  <div>
    <header>
        <h2>Que puedes hacer en esta pagina?</h2>
    </header>
    <body>
      <h5>Bienvenido a esta parte de nuestra web, aqui podras:</h5>
      <div class="informacion">
      <div id="buscar" class="card"><v-icon color="#d5832e" size="90px">mdi-comment-eye</v-icon><p>-Buscar y ver diferentes recursos que hay a tu alrededor</p></div>
      <div id="crud" class="card"><v-icon color="#d5832e" size="90px">mdi-map-marker</v-icon><p>-Crear, editar y eliminar tu propio recurso.</p>
      <span>"AVISO: antes de que se vea en el mapa general, el encargado de P.D.A.Bullying tendra que validar tu propuesta"</span>
      </div>
      <div id="mapaPropio" class="card"><v-icon color="#d5832e" size="90px">mdi-map-marker-alert</v-icon><p>-Añadir y eliminar los centros que quieras a tu mapa propio.</p></div>
      <div id="configuracionMapa" class="card"><v-icon color="#d5832e" size="90px">mdi-settings</v-icon><p>-Guardar la configuración de tu mapa propio( zoom y centrado del mapa ).</p></div>
      <div id="iframe" class="card"><v-icon color="#d5832e" size="90px">mdi-map-plus</v-icon><p>-Crear un Iframe del mapa propio para la pagina web de tu centro.</p></div>
      </div>
    </body>
    <footer>
    </footer>
  </div>
</template>

<script>
export default {
 name: 'Home'
}
</script>

<style scoped>
@media (min-width: 150px){
    .informacion{
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 250px 250px 250px;
    column-gap: 20px;
    row-gap:20px;
  }
    
}

@media (min-width: 650px){
    .informacion{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-rows: 250px 250px 250px;
    column-gap: 20px;
    row-gap:20px;
  }

  
}
@media (min-width: 1100px){
  .informacion{
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    grid-template-rows: 250px 250px;
    column-gap: 20px;
    row-gap:20px;
    align-items: center;
    justify-items: center;
  }

  p{
    font-size: 16px;
    margin-top: 10px;
    margin-left: 2%;
  }
}
.card{
    height: 100%;
    width: 100%; 
    background-color: white;
    border-radius: 10px;
    box-shadow: 5px 7px 8px #9b9898;
    display: grid;
    grid-template-rows: 120px 40px 40px;
    text-align: center;
  }
  span{
    color:rgb(247, 93, 93);
    font-size:11px;
    grid-row: 3/4;
    margin-top: 20px;
  }
  p{
    grid-row: 2/3;
  }
  header{
    display: grid;
    justify-items: left;
  }
  body{
    display: grid;
    justify-items: left;
    margin-left: 1%;
  }
  h5{
    font-weight: bolder;
    font-size: 20px;
    color: black;
    margin-bottom: 20px;
  }
</style>