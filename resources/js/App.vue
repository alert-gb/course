<template>
  <component :is="currentComponent()"></component>
</template>

<script>
import SiteContent from "./components/UI/SiteContent.vue";
import BaseAdmin from "./components/UI/admin/BaseAdmin.vue";
export default {
  components: {
    SiteContent,
    BaseAdmin,
  },

  methods: {
    currentComponent() {
      const route = this.$route.path;
      if (route == "/admin" || RegExp('^/admin//*').test(route)) {
        return "base-admin";
      } else {
        return "site-content";
      }
    },
  },
};
</script>

<style>
body {
  font-size: 0.875rem;
}
.jumbotron {
  padding-top: 3rem;
  padding-bottom: 3rem;
  margin-bottom: 0;
  background-color: #fff;
}
@media (min-width: 768px) {
  .jumbotron {
    padding-top: 6rem;
    padding-bottom: 6rem;
  }
}

.jumbotron p:last-child {
  margin-bottom: 0;
}

.jumbotron h1 {
  font-weight: 300;
}

.jumbotron .container {
  max-width: 40rem;
}

footer {
  padding-top: 3rem;
  padding-bottom: 3rem;
}

footer p {
  margin-bottom: 0.25rem;
}
/* Start form style */
input {
  border: 1px solid rgb(179, 179, 179) !important;
  text-align: center;
  padding: 1rem;
}
/* End form style */
span[role="alert"] {
  color: crimson;
}
/* Validation style */


</style>