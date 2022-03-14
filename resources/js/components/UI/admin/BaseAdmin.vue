<template>
  <div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <router-link to="/  " target="_blank">
          <h1>MyCourses</h1>
        </router-link>
      </div>

      <ul class="list-unstyled components">
        <li>
          <router-link to="/admin">
            <span>Dashboard</span>
          </router-link>
        </li>
        <li>
          <router-link to="/admin/categories">
            <span>Categories</span>
          </router-link>
        </li>
        <li>
          <a
            href="#pageSubmenu"
            data-toggle="collapse"
            aria-expanded="false"
            class="dropdown-toggle"
            >Pages</a
          >
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
              <a href="#">Page 1</a>
            </li>
            <li>
              <a href="#">Page 2</a>
            </li>
            <li>
              <a href="#">Page 3</a>
            </li>
          </ul>
        </li>
      </ul>

      <ul class="list-unstyled CTAs">
        <li>
          <a
            href="https://bootstrapious.com/tutorial/files/sidebar.zip"
            class="download"
            >Download source</a
          >
        </li>
        <li>
          <a
            href="https://bootstrapious.com/p/bootstrap-sidebar"
            class="article"
            >Back to article</a
          >
        </li>
      </ul>
    </nav>

    <!-- Page Content Holder -->
    <div id="content">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="navbar-btn">
            <span></span>
            <span></span>
            <span></span>
          </button>
          <button
            class="btn btn-dark d-inline-block d-lg-none ml-auto"
            type="button"
            data-toggle="collapse"
            data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">Amr Ragab</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="#">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container-fluid py-4">
        <router-view></router-view>
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
$("ul li").on("click", function () {
  $("ul").find("li.active").removeClass("active");
  $(this).parent("li").addClass("active");
});
</script>


<style scoped>
a.router-link-active {
  background: #53609b;
}
</style>