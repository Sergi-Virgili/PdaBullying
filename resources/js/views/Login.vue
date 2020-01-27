<template>
  <v-card width="400" class="mx-auto mt-5">
    <v-card-title class="pb-0">
      <h1>Login</h1>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Email" prepend-icon="mdi-account" v-model="email" />
        <v-text-field
          :type="showPassword ? 'text' : 'password'"
          label="Password"
          prepend-icon="mdi-lock-outline"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"
          v-model="password"
        />
      </v-form>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn class="rounded" @click="login" tile outlined color="success">
        <span>Login</span>
      </v-btn>
      <span>
        <a href>Registrate</a>
      </span>
    </v-card-actions>
  </v-card>
</template>

<script>
import { AUTH_REQUEST } from "../store/actions/auth";

export default {
  data() {
    return {
      showPassword: false,
      email: "a@test.com",
      password: "password"
    };
  },

  methods: {
    login: function() {
      const { email, password } = this;
      this.$store.dispatch(AUTH_REQUEST, { email, password }).then(() => {
        this.$router.push("/");
      });
    }
  }
};
</script>

<style>
</style>
