<template>
  <form
    @submit.prevent="Delete()"
    class="bg-outline-danger"
    enctype="multipart/form-data"
  >
    <h5>Are You Sure You want To Delete This Course ?</h5>
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
  props: ["course"],
  data() {
    const route = useRoute();
    return {
      categorySlug: route.params.adminCategorySlug,
    };
  },
  methods: {
    ...mapActions(["deleteCategoryCourse", "getCategoryCourses"]),
    Delete() {
      const slug = this.categorySlug;
      
      const id = this.course.id;
      this.deleteCategoryCourse(id).then(() => {
        this.loadCategoryCourses(slug);
        this.$toast.success(`Course Deleted Successfully`);
      });
      $("#publicModal").modal("hide");
    },
    loadCategoryCourses(slug) {
      setTimeout(() => {
        this.getCategoryCourses(slug);
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