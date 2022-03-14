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
          <Form @submit="handleRegister">
            <div
              class="
                d-flex
                flex-row
                align-items-center
                justify-content-center justify-content-lg-start
              "
            ></div>

            <!-- Name input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="email">Full Name</label>
              <Field
                type="text"
                id="name"
                name="name"
                class="form-control form-control-lg"
                placeholder="Enter your full name"
                v-model="name"
                :validateOnInput="true"
                :rules="validateField"
              />
              <ErrorMessage name="email" />
            </div>

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
                :validateOnInput="true"
                :rules="validateField"
              />
              <ErrorMessage name="email" />
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
                :validateOnInput="true"
                :rules="validateField"
              />
              <ErrorMessage name="password" />
            </div>

            <!-- Password Confirmation input -->
            <div class="form-outline mb-3">
              <label class="form-label-" for="password_confirmation"
                >Confirm Password</label
              >
              <Field
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control form-control-lg"
                placeholder="Confirm password"
                v-model="password_confirmation"
                :validateOnInput="true"
                :rules="validateField"
              />
              <ErrorMessage name="password_confirmation" />
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button
                type="submit"
                class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem"
              >
                Register
              </button>
              <p class="fw-bold mt-2 pt-1 mb-0">
                You Already Have an Account?
                <router-link class="link-danger" to="/login">
                  <span class="badge badge-info">Login</span>
                </router-link>
              </p>
            </div>
          </Form>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import { useRoute } from "vue-router";
export default {
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  data() {
    return {
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
    };
  },
  methods: {
    handleRegister() {
      const formData = new FormData();
      const router = useRoute();

      formData.append("name", this.name);
      formData.append("email", this.email);
      formData.append("password", this.password);
      formData.append("password_confirmation", this.password_confirmation);
      axios
        .post("/api/register", formData)
        .then((res) => {
          this.name =
            this.email =
            this.password =
            this.password_confirmation =
              "";
          router.replace('/login');
          this.$toast.success(`You Have Registered Successfully`);
        })
        .catch((error) => {
          this.$toast.error(error.data.message);
        });
    },
    validateField(value) {
      const min = 8;
      const max = 50;
      if (value && value.trim()) {
        if (value.trim().length >= min && value.trim().length <= max) {
          return true;
        } else {
          return (
            "Field Should not Be less than " + min + " or more than " + min
          );
        }
      } else {
        return "This Field Is Required";
      }
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