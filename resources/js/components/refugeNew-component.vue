<template>
  <div class="card">
    <div class="card-header">Nova Localització</div>
    <div class="card-body">
      <label for="name">Nom</label>
      <input class="form-control" type="text" name="name" id="name" />
      <label for="name">description</label>
      <input class="form-control" type="text" name="description" id="description" />
      <div>
        <p>geoposition: {{newGeoMarker}}</p>
      </div>
      <button class="btn btn-success">OK</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["newGeoMarker"]
};
</script>

<style>
</style>
