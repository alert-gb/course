<template>
  <div class="row">
    <div class="col-md-5 mb-3">
      <modal-button btn-class="btn btn-info" @click="toggleformCreate()">
        <i class="fa fa-plus-square"></i> Add Section
      </modal-button>
    </div>
  </div>
  <the-modal title="Course">
    <keep-alive>
      <component :section="section" :is="currentComponent"></component>
    </keep-alive>
  </the-modal>
  <div class="title text-center">
    <h4>
      <span class="badge bg-info text-white">{{ getTitle }} Sections</span>
    </h4>
  </div>
  <table class="table table-striped table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Title</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody class="table-white">
      <tr v-if="noData">
        <td colspan="4">
          <h4>No Data Added Yet</h4>
        </td>
      </tr>
      <tr v-for="(section, i) in getterCourseSections" :key="i">
        <td>{{ section.id }}</td>
        <td>{{ section.title }}</td>
        <td class="d-flex justify-content-around">
          <modal-button
            btn-class="btn btn-sm btn-success"
            @click="toggleformEdit({...section})"
          >
            <span class="fa fa-edit"></span> Edit
          </modal-button>
          <modal-button
            btn-class="btn btn-sm btn-danger"
            @click="toggleformDelete(section)"
          >
            <span class="fa fa-trash"></span> Delete
          </modal-button>
          <router-link
            class="btn btn-sm btn-info"
            :to="{name: 'adminSectionVideo', params: {adminSectionSlug: section.slug}}"
          >
          <span class="fa fa-eye"></span> View
          </router-link>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { useRoute } from "vue-router";
import FormCreate from "./FormCreate.vue";
import FormUpdate from "./FormUpdate.vue";
import FormDelete from "./FormDelete.vue";
export default {
  components: {
    FormCreate,
    FormUpdate,
    FormDelete,
  },
  computed: {
    ...mapGetters(["getterCourseSections"]),
    noData() {
      return !(this.getterCourseSections?.length > 0);
    },
    getTitle() {
      return this.$route.params.adminCourseSlug.replace("-", " ");
    },
  },
  data() {
    return {
      section: null,
      currentComponent: null,
    };
  },
  methods: {
    ...mapActions(["getCourseSections"]),
    toggleformCreate() {
      this.currentComponent = "FormCreate";
    },
    toggleformEdit(section) {
      this.section = section;
      this.currentComponent = "FormUpdate";
    },
    toggleformDelete(section) {
      this.section = section;
      this.currentComponent = "FormDelete";
    }
  },
  created() {
    const route = useRoute();
    const courseSlug = route.params.adminCourseSlug;
    this.getCourseSections(courseSlug);
  },
};
</script>
<style scoped>
table {
  margin-left: auto;
  margin-right: auto;
  width: 80%;
}
</style>