<template>
  <div class="modal-btn">
    <modal-button btn-class="btn btn-primary mb-5" @click="toggleformCreate()">
      <i class="fa fa-plus-square"></i> Create Category
    </modal-button>
  </div>
  <the-modal title="Category">
    <keep-alive>
      <component :category="category" :is="currentComponent"></component>
    </keep-alive>
  </the-modal>
  <div class="text-center" v-if="isLoading">
    <base-spinner></base-spinner>
  </div>
  <div class="row" v-else-if="hasData">
    <div class="col-lg-4" v-for="(category, i) in getterCategories" :key="i">
      <div class="card mb-4 shadow-sm">
        <img
          :src="'/' + category.photo"
          class="bd-placeholder-img card-img-top img-thumbnail"
          height="200"
          role="img"
          aria-label="Placeholder: Thumbnail"
          preserveAspectRatio="xMidYMid slice"
          focusable="false"
        />

        <div class="card-body text-center">
          <div class="d-flex flex-column">
            <strong class="card-text">
              {{ category.title }}
            </strong>
            <strong class="card-text">
              Courses: {{ category.courses.length }}
            </strong>
          </div>
          <div class="d-flex justify-content-center align-items-center mt-3">
            <div class="btn-group">
              <!-- <a target="blank" href="https://stackoverflow.com/questions/63967346/install-vue-3-0-in-laravel" class="btn btn-sm btn-outline-secondary">
                install vue
              </a> -->
              <!-- <a target="blank" href="https://www.tutsmake.com/laravel-8-vue-js-crud-tutorial-example/" class="btn btn-sm btn-outline-secondary">
              CRUD AXIOS
              </a> -->
              <!-- <router-link 
              class="btn btn-outline-info" 
              :to="{ name: 'categorycourses', params: { categorySlug: category.slug }}">
              View
              </router-link> -->
              <router-link
                class="btn btn-info"
                :to="{
                  name: 'adminCategoryCourses',
                  params: { adminCategorySlug: category.slug },
                }"
              >
                View
              </router-link>

              <modal-button
                btn-class="btn btn-primary"
                @click="toggleFormDelete(category)"
              >
                Delete
              </modal-button>
              <modal-button
                btn-class="btn btn-success"
                @click="toggleFormUpdate({ ...category })"
              >
                Edit
              </modal-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="no-data text-center badge bg-dark" v-else>
    <h4 class="text-white">No Data Found!</h4>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

import FormCreate from "./FormCreate.vue";
import FormDelete from "./FormDelete.vue";
import FormUpdate from "./FormUpdate.vue";
// import * as yup from 'yup';
export default {
  components: {
    FormCreate,
    FormDelete,
    FormUpdate,
  },
  computed: {
    ...mapGetters(["getterCategories"]),
    hasData() {
      return !this.isLoading && this.getterCategories?.length > 0;
    },
  },
  data() {
    return {
      category: null,
      currentComponent: null, //{ FormCreate, FormDelete, FormUpdate}
      isLoading: true,
    };
  },
  methods: {
    ...mapActions(["getCategories", "getCategoryCourses"]),
    async loadCategories() {
      this.isLoading = true;
      await this.getCategories();
      this.isLoading = false;
    },
    toggleformCreate() {
      this.currentComponent = "FormCreate";
    },
    toggleFormDelete(category) {
      this.category = category;
      this.currentComponent = "FormDelete";
    },
    toggleFormUpdate(category) {
      this.category = category;
      this.currentComponent = "FormUpdate";
    },
  },
  created() {
    this.loadCategories();
  },
};
</script>

<style scoped>
.card {
  height: auto;
  overflow-y: scroll;
}
.card {
  overflow: auto;
}
.card-img-top {
  height: 15rem;
}
</style>