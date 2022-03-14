<template>
  <form @submit.prevent="Delete()" enctype="multipart/form-data">
    <h5>Are You Sure You want To Delete This Video ?</h5>
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
  props: ["video"],
  data() {
    const route = userRoute();
    return {
      sectionSlug: route.params.adminSectionSlug
    }
  },
  methods: {
    ...mapActions(["deleteSectionVideo", "getSectionVideos"]),
    Delete() {
      this.deleteSectionVideo({id: this.video.id }).then(() => {
        this.loadSectionVideos(this.sectionSlug);
        this.$toast.success(`Video Deleted Successfully`);
      });
      $("#publicModal").modal("hide");
    },
    loadSectionVideos(slug) {
      setTimeout(() => {
        this.getSectionVideos(slug);
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