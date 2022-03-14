<template>
  <Form @submit="submitForm" enctype="multipart/form-data">
    <div class="form-group pb-2">
      <label for="title">title</label>
      <Field
        type="text"
        class="form-control bordered"
        id="title"
        placeholder="Enter title"
        name="title"
        v-model="course.title"
        :validateOnInput="true"
        :rules="validateTitle"
      />
      <ErrorMessage name="title" />
    </div>
    <div class="form-group pb-2">
      <label for="description">Description</label>
      <Field
        type="text"
        class="form-control bordered"
        id="description"
        placeholder="Enter description"
        name="description"
        v-model="course.description"
        :validateOnInput="true"
        :rules="validateDescription"
      />
    </div>
    <ErrorMessage name="description" />
    <div class="form-group pb-2">
      <label for="photo">photo</label>
      <Field
        type="file"
        class="form-control"
        id="photo"
        name="photo"
        accept="image/jpeg ,image/jpg , image/png "
        @change="atFileChange"
      />
    </div>
    <button type="submit" class="btn btn-success">Edit</button>
  </Form>
</template>

<script>
import { Form, Field, ErrorMessage } from "vee-validate";
import { useRoute } from "vue-router";
import { mapActions } from "vuex";
export default {
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  props: ["course"],
  data() {
    const route = useRoute();
    return {
      categorySlug: route.params.adminCategorySlug,
    };
  },
  methods: {
    ...mapActions(["updateCategoryCourse", "getCategoryCourses"]),
    atFileChange(event) {
      this.course.photo = event.target.files[0];
    },
    submitForm() {
      const categorySlug = this.categorySlug;
      //send form data to api
      const data = new FormData();
      data.append("title", this.course.title);
      data.append("description", this.course.description);
      data.append("photo", this.course.photo);
      data.append(
        "_token",
        document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content")
      );
      data.append("_method", "put");
      const courseSlug = this.course.slug;
      this.updateCategoryCourse({ slug: courseSlug, data: data }).then(() => {
        this.loadCategoryCourses(categorySlug);
        this.$toast.success(`Course Updated Successfully`);
      });
        $('#publicModal').modal('hide');
      //reset inputs after submit course
    },
    loadCategoryCourses(slug) {
      setTimeout(() => {
        this.getCategoryCourses(slug);
      }, 3000);
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
    validateDescription(value) {
      if (value && value.trim()) {
        if (value.trim().length >= 8 && value.trim().length <= 50) {
          return true;
        } else {
          return (
            "Description Should not Be less than " + 8 + " or more than " + 150
          );
        }
      } else {
        return "Description Field Is Required";
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