<template>
  <v-card width="400" class="mx-auto mt-5">
    <v-card-title class="pb-0">
      <h1>Login</h1>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Email" prepend-icon="mdi-account" />
        <v-text-field
          :type="showPassword ? 'text' : 'password'"
          label="Password"
          prepend-icon="mdi-lock-outline"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"
        />
      </v-form>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn class="rounded" tile outlined color="success">
        <span>Login</span>
      </v-btn>
      <span>
        <a href>¿No te acurdas de la contraseña?</a>
      </span>
    </v-card-actions>
  </v-card>
</template>

<script>
import Auth from "../apis/Auth";

export default {
  data() {
    return {
      showPassword: false,
      data: {
        email: "a@test.com",
        password: "password"
      }
    };
  },
  mounted() {
    this.login();
  },

  methods: {
    login() {
      Auth.login(this.data).then(res => console.log(res));
    }
  }
};
</script>

<style>
</style>
