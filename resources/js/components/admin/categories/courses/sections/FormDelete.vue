<template>
  <form @submit.prevent="Delete()" enctype="multipart/form-data">
    <h5>Are You Sure You want To Delete This Section ?</h5>
    <button data-bs-dismiss="modal" type="submit" class="btn btn-danger">
      Delete
    </button>
  </form>
</template>

<script>
import { mapActions } from "vuex";
import { useRoute } from "vue-router";
export default {
  components: {},
  props: ["section"],
  data() {
    const route = useRoute();
    return {
      courseSlug: route.params.adminCourseSlug,
    };
  },
  methods: {
    ...mapActions(["deleteCourseSection", "getCourseSections"]),
    Delete() {
      const id = this.section.id;
      this.deleteCourseSection({ id: id }).then(() => {
        this.loadCourseSections(this.courseSlug);
        this.$toast.success(`Section Deleted Successfully`);
      });
      $("#publicModal").modal("hide");
    },
    loadCourseSections(slug) {
      setTimeout(() => {
        this.getCourseSections(slug);
      }, 1000);
    },
  },
};
</script>

<style scoped>
form {
  height: auto;
}
</style>