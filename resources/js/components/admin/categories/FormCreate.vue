<template>
  <div class="row" v-if="isLoading">
    <base-spinner></base-spinner>
  </div>
  <Form @submit="submitForm" enctype="multipart/form-data">
    <div class="form-group pb-2">
      <label for="title">title</label>
      <Field
        type="text"
        class="form-control bordered"
        id="title"
        placeholder="Enter title"
        name="title"
        v-model="category.title"
        :validateOnInput="true"
        :rules="validateTitle"
      />
      <ErrorMessage name="title" />
    </div>
    <div class="form-group pb-2">
      <label for="photo">photo</label>
      <Field
        type="file"
        class="form-control"
        id="photo"
        name="photo"
        accept="image/jpeg ,image/jpg , image/png "
        @change="atFileChange"
        :validateOnInput="true"
        :rules="validatePhoto"
      />
      <ErrorMessage name="photo" />
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
  </Form>
</template>

<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import { mapActions } from "vuex";
export default {
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  props: ["category"],
  data() {
    return {
      category: {
        title: null,
        photo: null,
      },
      isLoading: false,
    };
  },
  methods: {
    ...mapActions(["createCategory", "getCategories"]),
    atFileChange(event) {
      this.category.photo = event.target.files[0];
    },
    submitForm() {
      //send form data to api
      const formData = new FormData();
      formData.append("title", this.category.title);
      formData.append("photo", this.category.photo);
      formData.append(
        "_token",
        document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content")
      );

      this.addCategory(formData);

      //reset inputs after submit category
    },
    async addCategory(formData) {
      this.isLoading = true;
      await this.createCategory(formData);
      this.isLoading = true;
      this.loadCategories();
      $("#publicModal").modal("hide");
      this.$toast.success(`Category Created Successfully`);
    },

    async loadCategories() {
      await this.getCategories();
    },

    validateTitle(value) {
      const min = 8;
      const max = 50;
      if (value && value.trim()) {
        if (value.trim().length >= min && value.trim().length <= max) {
          return true;
        } else {
          return (
            "Title Should not Be less than " + min + " or more than " + min
          );
        }
      } else {
        return "Title Field Is Required";
      }
    },
    validatePhoto(value) {
      if (value) {
        return true;
      }
      return "Photo Field Is Required";
    },
  },
};
</script>

<style scoped>
.input {
  border: 1px solid #eee !important;
}
</style>