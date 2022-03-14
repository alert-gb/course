<template>
  <!-- categories count -->
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card text-center bg-dark">
        <hr class="dark horizontal my-0" />
        <div class="card-header p-3 pt-2">
          <div class="text-end pt-1" id="category">
            <p class="text-capitalize text-white">categories</p>
            <h4 class="mb-0 text-white">{{ getterCategoriesLength }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card bg-success text-center">
        <hr class="dark horizontal my-0" />
        <div class="card-header p-3 pt-2">
          <div class="text-end pt-1" id="course">
            <p class="text-capitalize text-white">Courses</p>
            <h4 class="mb-0 text-white">{{ getterCoursesLength }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card bg-info text-center">
        <hr class="dark horizontal my-0" />
        <div class="card-header p-3 pt-2">
          <div class="text-end pt-1" id="section">
            <p class="text-capitalize text-white">Sections</p>
            <h4 class="mb-0 text-white">{{ getterSectionsLength }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
      </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card bg-danger text-center">
        <hr class="dark horizontal my-0" />
        <div class="card-header p-3 pt-2">
          <div class="text-end pt-1" id="video">
            <p class="text-capitalize text-white">Videos</p>
            <h4 class="mb-0 text-white">{{ getterVideosLength }}</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0" />
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters([
      "getterCategoriesLength",
      "getterCoursesLength",
      "getterSectionsLength",
      "getterVideosLength",
    ]),
  },
  methods: {
    ...mapActions([
      "getCategoriesLength",
      "getCoursesLength",
      "getSectionsLength",
      "getVideosLength",
    ]),
  },
  created() {
    this.getCategoriesLength();
    this.getCoursesLength();
    this.getSectionsLength();
    this.getVideosLength();
  },
};
</script>


<style scoped>
#category::before {
  content: "\f5fd";
  font-family: FontAwesome;
  position: absolute;
  font-size: 105px;
  color: #fff;
  opacity: 0.2;
  top: calc(50% - 75px);
  left: calc(50% - 52px);
}

#course::before {
  content: "\f02d";
  font-family: FontAwesome;
  position: absolute;
  font-size: 105px;
  color: #fff;
  opacity: 0.2;
  top: calc(50% - 75px);
  left: calc(50% - 52px);
}

#section::before {
  content: "\f5fd";
  font-family: FontAwesome;
  position: absolute;
  font-size: 105px;
  color: #fff;
  opacity: 0.2;
  top: calc(50% - 75px);
  left: calc(50% - 52px);
}

#video::before {
  content: "\f03d";
  font-family: FontAwesome;
  position: absolute;
  font-size: 105px;
  color: #fff;
  opacity: 0.2;
  top: calc(50% - 75px);
  left: calc(50% - 52px);
}
</style>