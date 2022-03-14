<template>
  <div class="col-sm-8" v-if="video !== null">
    <course-video :video="video"></course-video>
  </div>
  <div class="col-sm-8" v-else>
    <course-video :video="getterFirstVideo"></course-video>
  </div>
  <div class="accordion col-md-4" id="exampleAccordion">
    <div class="card" v-for="(section, i) in getterCourseSections" :key="i">
      <div class="card-header" id="exItem1Header">
        <h6 class="mb-0">
          <button
            class="btn collapsed"
            type="button"
            data-toggle="collapse"
            :data-target="'#exItem' + i"
            aria-expanded="false"
            aria-controls="exItem1"
          >
            <strong class="d-flex">
              <span class="section-counter">{{ i + 1 }}.  </span>
              <span class="section-title">{{ section.title }}</span>
            </strong>
          </button>
        </h6>
      </div>
      <div
        :id="'exItem' + i"
        class="collapse"
        :class="i === 0 ? 'show' : ''"
        aria-labelledby="exItem1Header"
        data-parent="#exampleAccordion"
      >
        <div
          class="card-body p-0"
          v-for="(video, j) in section.videos"
          :key="j"
        >
          <button
            @click="toggleVideo({ ...video })"
            class="btn text-muted bg-white"
          >
            <span>{{ j + 1 }}.</span>
            {{ video.title }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
import { useRoute } from "vue-router";
import CourseVideo from "./CourseVideo.vue";
export default {
  components: {
    CourseVideo,
  },
  computed: {
    ...mapGetters(["getterCourseSections", "getterFirstVideo"]),
  },
  data() {
    return {
      video: null,
    };
  },
  methods: {
    ...mapActions(["getCourseSections", "getFirstVideo"]),
    toggleVideo(video) {
      this.video = video;
    },
  },
  created() {
    const route = useRoute();
    const courseSlug = route.params.courseSlug;
    this.getCourseSections(courseSlug);
    this.getFirstVideo(courseSlug);
  },
};
</script>
<style scoped>
video {
  width: 100%;
  height: 25rem;
  object-fit: cover;
}
.accordion {
  height: 25rem;
  overflow-y: auto;
  padding: 0;
}
.card-header {
  padding: 0;
}
.card-body {
  padding: 0;
  border-bottom: 1px solid #eee;
}
.card-header button, .card-body button {
  width: 100%;
  text-align: left;
}
</style>