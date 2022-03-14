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
import { useRoute } from "vue-router";
import { mapActions } from "vuex";
export default {
  components: {
    Form,
    Field,
    ErrorMessage,
  },
  props: ["toaster"],
  data() {
    const route = useRoute();
    return {
      course: {
        title: null,
        description: null,
        photo: null,
      },
      categorySlug: route.params.adminCategorySlug,
    };
  },
  methods: {
    ...mapActions(["createCategoryCourse", "getCategoryCourses"]),
    atFileChange(event) {
      this.course.photo = event.target.files[0];
    },
    submitForm() {
      const slug = this.categorySlug;

      //send form data to backend
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

      // use action to create course
      this.createCategoryCourse({ slug: slug, data: data }).then(() => {
        this.loadCategoryCourses(slug);
        this.$toast.success(`Course Created Successfully`);
      });
      $("#publicModal").modal("hide");
      
      //reset inputs after submit cours
      this.course.title = '';
      this.course.photo = null;
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