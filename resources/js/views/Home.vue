<template>
  <div class="conatainer">
    <header>
        <h2>Que puedes hacer en esta pagina?</h2>
    </header>
    <body>
      <h5>Bienvenido a esta parte de nuestra web, aqui podras:</h5>
      <p>-Buscar y ver diferentes recursos que hay a tu alrededor</p>
      <p>-Crear, editar y eliminar tu propio recurso. <span style="color:rgb(247, 93, 93)">"AVISO: antes de que se vea en el mapa general, el encargado de P.D.A.Bullying tendra que validar tu propuesta"</span></p>
      <p>-Añadir y eliminar los centros que quieras a tu mapa propio.</p>
      <p>-Guardar la configuración de tu mapa propio( zoom y centrado del mapa ).</p>
      <p>-Crear un Iframe del mapa propio para la pagina web de tu centro.</p>
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
p{
  font-size: 18px;
  margin-top: 10px;
  margin-left: 2%;
}
</style>