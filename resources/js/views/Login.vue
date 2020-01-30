<template>
  <v-card width="400" class="mx-auto mt-5">
    <v-card-title class="pb-0">
      <h1>Login</h1>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field label="Email" prepend-icon="mdi-account" v-model="form.email" />
        <v-text-field
          :type="showPassword ? 'text' : 'password'"
          label="Password"
          prepend-icon="mdi-lock-outline"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"
          v-model="form.password"
        />
      </v-form>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-btn class="rounded" @click="authenticate" tile outlined color="success">
        <span>Login</span>
      </v-btn>
      <span>
        <a href>Registrate</a>
      </span>
    </v-card-actions>
    <v-alert v-if="authError">{{authError}}</v-alert>
  </v-card>
</template>

<script>

import { login } from "../apis/Auth";

export default {
  data() {
    return {
      showPassword: false,
      form: {
        email: "root@root.com",
        password: "12345678"
      }
    };
  },

  methods: {
    authenticate() {
      this.$store.dispatch("login");
      login(this.form)
        .then(res => {
          this.$store.commit("loginSuccess", res);
          this.$router.push({ path: "/dashboard" });
        })

        .catch(error => {
          this.$store.commit("loginFailed", { error });
        });
    }
  },
  computed: {
    authError() {
      return this.$store.getters.authError;
    }
  }
};
</script>


