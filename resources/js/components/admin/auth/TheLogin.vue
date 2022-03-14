<template>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img
            src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
            class="img-fluid"
            alt="Sample image"
          />
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <Form @submit="handleLogin">
            <div
              class="
                d-flex
                flex-row
                align-items-center
                justify-content-center justify-content-lg-start
              "
            ></div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="email">Email address</label>
              <Field
                type="email"
                id="email"
                name="email"
                class="form-control form-control-lg"
                placeholder="Enter a valid email address"
                v-model="email"
              />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <label class="form-label" for="password">Password</label>
              <Field
                type="password"
                id="password"
                name="password"
                class="form-control form-control-lg"
                placeholder="Enter password"
                v-model="password"
              />
              
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input
                  class="form-check-input me-2"
                  type="checkbox"
                  value=""
                  id="remember_me"
                  name="remember_me"
                />
                <label class="form-check-label" for="remember_me">
                  Remember me
                </label>
              </div>
              <a href="#!" class="text-body">Forgot password?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button
                type="submit"
                class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem"
              >
                Login
              </button>
              <p class="fw-bold mt-2 pt-1 mb-0">
                Don't have an account?
                <a href="#!" class="link-danger">
                  <span class="badge badge-info">Register</span>
                </a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { Form, Field, ErrorMessage } from "vee-validate";

export default {
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  data() {
    return {
      email: "",
      password: "",
      device_name: "browser",
    };
  },
  methods: {
    handleLogin() {
      const formData = new FormData();
      formData.append("email", this.email);
      formData.append("password", this.password);
      formData.append("device_name", this.device_name);
      axios.get("/sanctum/csrf-cookie").then(() => {
        axios.post("/api/login", formData).then((res) => {
          localStorage.setItem("token", res.data);
          this.$router.replace('/admin')
        });
      });
    },
  },
};
</script>

<style scoped>
.h-custom {
  height: calc(100% - 73px);
}
@media (max-width: 450px) {
  .h-custom {
    height: 100%;
  }
}
</style>