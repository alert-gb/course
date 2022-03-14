<template>
  <div class="col-md-4" v-for="(course, i) in getterCategoryCourses" :key="i">
    <div class="card mb-4 shadow-sm">
      <img
        :src="'/' + course.photo"
        class="bd-placeholder-img card-img-top"
        height="200"
        role="img"
        aria-label="Placeholder: Thumbnail"
        preserveAspectRatio="xMidYMid slice"
        focusable="false"
      />
      <div class="card-body">
        <p class="card-text">
          {{ course.description }}
        </p>
        <div class="d-flex justify-content-between align-items-center">
          <div class="btn-group">
            <router-link 
            class="btn btn-outline-danger" 
            :to="{name: 'course', params:{courseSlug: course.slug}}">
            View Course
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { useRoute } from "vue-router";
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters(["getterCategoryCourses"]),
  },
  methods: {
    ...mapActions(["getCategoryCourses"]),
  },
  created() {
    const route = useRoute();
    const slug = route.params.categorySlug;
    this.getCategoryCourses(slug);
    
  },
};
</script>
