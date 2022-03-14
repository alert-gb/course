<template>
  <div class="text-center" v-if="isLoading">
    <base-spinner></base-spinner>
  </div>
  <div class="row" v-else-if="hasData">
    <div class="col-lg-4" v-for="(category, i) in getterCategories" :key="i">
      <div class="card mb-4 shadow-sm">
        <img
          :src="category.photo"
          class="bd-placeholder-img card-img-top"
          height="200"
          role="img"
          aria-label="Placeholder: Thumbnail"
          preserveAspectRatio="xMidYMid slice"
          focusable="false"
        />

        <div class="card-body">
          <p class="card-text">
            {{ category.title }}
          </p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <router-link
                class="btn btn-outline-info"
                :to="{
                  name: 'categorycourses',
                  params: { categorySlug: category.slug },
                }"
              >
                View
              </router-link>
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

export default {
  computed: {
    ...mapGetters(["getterCategories"]),
    hasData() {
      return !this.isLoading && this.getterCategories?.length > 0;
    },
  },
  data() {
    return {
      isLoading: false,
    };
  },
  methods: {
    ...mapActions(["getCategories"]),
    async loadCategories() {
      this.isLoading = true;
      await this.getCategories();
      this.isLoading = false;
    },
  },

  created() {
    this.loadCategories();
  },
};
</script>


<style scoped>
.card {
  height: 22rem;
  overflow-y: auto;
}
</style>