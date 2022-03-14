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
        v-model="section.title"
        :validateOnInput="true"
        :rules="validateTitle"
      />
      <ErrorMessage name="title" />
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
  props: ["section"],
  data() {
    const route = useRoute();
    return {
      courseSlug: route.params.adminCourseSlug,
    };
  },
  methods: {
    ...mapActions(["updateCourseSection", "getCourseSections"]),
    atFileChange(event) {
      this.course.photo = event.target.files[0];
    },
    submitForm() {
      const courseSlug = this.courseSlug;
      //send form data to api
      const data = new FormData();
      data.append("id", this.section.id);
      data.append("title", this.section.title);
      data.append(
        "_token",
        document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content")
      );
      data.append("_method", "put");
      this.updateCourseSection({ slug: courseSlug, data: data }).then(() => {
        this.loadSections(courseSlug);
        this.$toast.success(`Section Updated Successfully`);
      })
        $('#publicModal').modal('hide');
      //reset inputs after submit course
    },
    loadSections(slug) {
      setTimeout(() => {
        this.getCourseSections(slug);
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