<template>
  <div class="row">
    <div class="col-md-5 mb-3">
      <modal-button
        btn-class="btn btn-warning mb-5"
        @click="toggleformCreate()"
      >
        <i class="fa fa-plus-square"></i> Add Course
      </modal-button>
    </div>
  </div>
  <div class="row">
    <div class="no-data text-center badge bg-dark" v-if="noData">
      <h4 class="text-white">No Data Found!</h4>
    </div>
    <the-modal title="Course">
      <keep-alive>
        <component :course="course" :is="currentComponent"></component>
      </keep-alive>
    </the-modal>
    <div class="col-lg-4" v-for="(course, i) in getterCategoryCourses" :key="i">
      <div class="card mb-4 shadow-sm">
        <img
          :src="'/' + course.photo"
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
              {{ course.title }}
            </strong>
            <strong class="card-text">
              {{ course.description }}
            </strong>
            <strong class="card-text"> Videos: 20 </strong>
          </div>
          <div class="d-flex justify-content-center align-items-center mt-3">
            <div class="btn-group">
              <router-link
                class="btn btn-info"
                :to="{
                  name: 'adminSections',
                  params: { adminCourseSlug: course.slug },
                }"
              >
                View
              </router-link>
              <modal-button
                btn-class="btn btn-danger"
                @click="toggleFormDelete(course)"
              >
                Delete
              </modal-button>
              <modal-button
                btn-class="btn btn-success"
                @click="toggleFormUpdate({ ...course })"
              >
                Edit
              </modal-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useRoute } from "vue-router";
import FormCreate from "./FormCreate.vue";
import FormUpdate from "./FormUpdate.vue";
import FormDelete from "./FormDelete.vue";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    FormCreate,
    FormUpdate,
    FormDelete,
  },
  data() {
    return {
      currentComponent: "",
      course: "",
    };
  },
  computed: {
    ...mapGetters(["getterCategoryCourses"]),
    noData() {
      return !(this.getterCategoryCourses?.length > 0);
    },
  },
  methods: {
    ...mapActions(["getCategoryCourses"]),
    toggleformCreate() {
      this.currentComponent = "FormCreate";
    },
    toggleFormUpdate(course) {
      this.course = course;
      this.currentComponent = "FormUpdate";
    },
    toggleFormDelete(course) {
      this.course = course;
      this.currentComponent = "FormDelete";
    },
  },
  created() {
    const route = useRoute();
    const slug = route.params.adminCategorySlug;
    this.getCategoryCourses(slug);
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