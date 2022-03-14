<template>
  <div class="row" v-if="isLoading">
    <base-spinner></base-spinner>
  </div>
  <Form @submit="update" enctype="multipart/form-data">
    <Field type="hidden" name="_token" :value="category.csrf" />
    <Field type="hidden" name="_method" value="put" />
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
      />
    </div>
    <button type="submit" class="btn btn-success">Update</button>
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
      isLoading: false,
    }
  },
  methods: {
    ...mapActions(["updateCategory", "getCategories"]),
    atFileChange(event) {
      this.category.photo = event.target.files[0];
    },
    update() {
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
      formData.append("_method", "PUT");

      const categoryId = this.category.id;
      this.EditCategory(formData, categoryId);
    },
    async EditCategory(formData, categoryId) {
      this.isLoading = true;
      await this.updateCategory({ data: formData, id: categoryId });
      this.isLoading = false;
      this.loadCategories();
      $("#publicModal").modal("hide");
      this.$toast.success(`Category Updated Successfully`);
    },

    loadCategories() {
        this.getCategories();
    },
    validateTitle(value) {
      if (value && value.trim()) {
        if (value.trim().length >= 8 && value.trim().length <= 50) {
          return true;
        } else {
          return "Title Should not Be less than 8  or more than 50";
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