<template>
  <section class="card">
    <header class="card-header">Buscar</header>
    <main class="card-body">
      <div class="form-group">
        <input class="form-control" type="text" placeholder="buscar" />

        <div class="form-check" v-for="type in types">
          <input class="form-check-input" type="checkbox" value id="defaultCheck1" />
          <label class="form-check-label" for="defaultCheck1">tipo</label>
        </div>

        <button class="btn btn-success" @click="geo">Search</button>
      </div>
    </main>
  </section>
</template>

<script>
export default {
  data() {
    return {
      types: [1, 1, 1, 1]
    };
  }
};
</script>

<style>
</style>