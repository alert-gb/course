<template>
  <form @submit.prevent="Delete()" enctype="multipart/form-data">
    <h5>Are You Sure You want To Delete This category ?</h5>
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
</template>

<script>
import { mapActions } from "vuex";

export default {
  components: {},
  props: ["category"],
  methods: {
    ...mapActions(["deleteCategory", "getCategories"]),
    Delete() {
      this.deleteCategory(this.category.id).then(() => {
        this.loadCategories();
        this.$toast.success(`Category Deleted Successfully`);
      });
      $("#publicModal").modal("hide");
    },
    loadCategories() {
      setTimeout(() => {
        this.getCategories();
      }, 1000);
    }
  },
};
</script>

<style scoped>
form {
  height: auto;
}
</style>