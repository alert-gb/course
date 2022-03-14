<template>
  <div class="row">
    <div class="col-md-5 mb-3">
      <modal-button btn-class="btn btn-danger mb-5" @click="toggleformCreate()">
        <i class="fa fa-video"></i> Add Video
      </modal-button>
    </div>
  </div>

  <the-modal title="Video">
    <keep-alive>
      <component :video="video" :is="currentComponent"></component>
    </keep-alive>
  </the-modal>
  <div class="row">
    <div class="no-data text-center badge bg-dark" v-if="noData">
      <h4 class="text-white">No Data Found!</h4>
    </div>
    <div class="col-lg-4" v-for="(video, i) in getterSectionVideos" :key="i">
      <div class="card mb-4 shadow-sm">
        <img
          :src="'/' + video.photo"
          class="bd-placeholder-img card-img-top img-thumbnail"
          height="200"
          role="img"
          aria-label="Placeholder: Thumbnail"
          preserveAspectRatio="xMidYMid slice"
          focusable="false"
        />

        <div class="card-body text-center">
          <div class="d-flex flex-column">
            <strong class="card-text">
              {{ video.title }}
            </strong>
          </div>
          <div class="d-flex justify-content-center align-items-center mt-3">
            <div class="btn-group">
              <modal-button
                btn-class="btn btn-info"
                @click="toggleVideoView({...video})"
              >
                View
              </modal-button>
              <modal-button
                btn-class="btn btn-danger"
                @click="toggleFormDelete(video)"
              >
                Delete
              </modal-button>
              <modal-button
                btn-class="btn btn-success"
                @click="toggleFormUpdate({ ...video })"
              >
                Edit
              </modal-button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useRoute } from "vue-router";
import FormCreate from "./FormCreate.vue";
import FormUpdate from "./FormUpdate.vue";
import FormDelete from "./FormDelete.vue";
import VideoView from "./VideoView.vue";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    FormCreate,
    FormUpdate,
    FormDelete,
    VideoView,
  },
  data() {
    return {
      currentComponent: "",
      section: "",
      video: "",
    };
  },
  computed: {
    ...mapGetters(["getterSectionVideos"]),
    noData() {
      return !(this.getterSectionVideos?.length > 0);
    },
  },
  methods: {
    ...mapActions(["getSectionVideos"]),
    toggleformCreate() {
      this.currentComponent = "FormCreate";
    },
    toggleFormUpdate(video) {
      this.video = video;
      this.currentComponent = "FormUpdate";
    },
    toggleFormDelete(video) {
      this.video = video;
      this.currentComponent = "FormDelete";
    },
    toggleVideoView(video) {
      this.video = video;
      this.currentComponent = "VideoView";
    },
  },
  created() {
    const route = useRoute();
    const slug = route.params.adminSectionSlug;
    this.getSectionVideos(slug);
  },
};
</script>

<style scoped>
.card {
  height: auto;
  overflow-y: scroll;
}
.card {
  overflow: auto;
}
.card-img-top {
  height: 15rem;
}
</style>