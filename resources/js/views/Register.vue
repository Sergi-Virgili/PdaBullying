<template>
  <v-card width="400" class="mx-auto mt-5">
    <v-card-title class="pb-0">
      <h1>Regístrate</h1>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Nombre" prepend-icon="mdi-account" />
        <v-text-field label="Email" prepend-icon="mdi-email-outline" />

        <v-text-field
          :type="showPassword ? 'text' : 'password'"
          label="Password"
          prepend-icon="mdi-lock-outline"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"
        />
        <v-text-field
          :type="showPassword ? 'text' : 'password'"
          label="Confirma Password"
          prepend-icon="mdi-lock-outline"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"
        />
      </v-form>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn class="rounded" tile outlined color="success">
        <span>Register</span>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      showPassword: false
    };
  }
};
</script>

<style>
</style>
