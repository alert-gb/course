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
        v-model="video.title"
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
        accept="image/jpeg ,image/jpg , image/png"
        @change="atPhotoChange"
        :validateOnInput="true"
        :rules="validatePhoto"
      />
      <ErrorMessage name="photo" />
    </div>

    <div class="form-group pb-2">
      <label for="video">Video</label>
      <Field
        type="file"
        class="form-control"
        id="video"
        name="video"
        accept="video/*"
        @change="atVideoChange"
        :validateOnInput="true"
        :rules="validateVideo"
      />
      <ErrorMessage name="video" />
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
        video: {
            title: '',
            photo: '',
            video: '',
        },
      sectionSlug: route.params.adminSectionSlug,
    };
  },
  methods: {
    ...mapActions(["createSectionVideo", "getSectionVideos"]),
    atPhotoChange(event) {
      this.video.photo = event.target.files[0];
    },
    atVideoChange(event) {
      this.video.video = event.target.files[0];
    },
    submitForm() {
      const slug = this.sectionSlug;

      //send form data to api
      const data = new FormData();
      data.append("title", this.video.title);
      data.append("photo", this.video.photo);
      data.append("video", this.video.video);
      data.append(
        "_token",
        document
          .querySelector('meta[name="csrf-token"]')
          .getAttribute("content")
      );
      this.createSectionVideo({ slug: slug, data: data }).then(() => {
        this.loadSectionVideos(slug);
        this.$toast.success(`Video Created Successfully`);
      })
      $("#publicModal").modal("hide");
      
      //reset inputs after submit course
    },
    loadSectionVideos(slug) {
      setTimeout(() => {
        this.getSectionVideos(slug);
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
    validatePhoto(value) {
      if (value) {
        return true;
      }
      return "Photo Field Is Required";
    },
    
    validateVideo(value) {
      if (value) {
        return true;
      }
      return "Video Field Is Required";
    },
  },
};
</script>

<style scoped>
.input {
  border: 1px solid #eee !important;
}
</style>