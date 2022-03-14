<template>
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="/images/myimage.ico" alt="Amr Ragab" />
        <strong>My Courses</strong>
      </a>
      <form class="form-inline my-2 my-lg-0">
        <div class="row">
          <div class="col-sm-8">
            <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
          </div>
          <div class="col-sm-4">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
              Search
            </button>
          </div>
        </div>
      </form>
      <form class="form-inline">
        <router-link class="btn btn-sm btn-outline-info mr-3 text-info" to="/login">
          Login
        </router-link>
        <router-link class="btn btn-sm btn-outline-primary text-primary" to="/register">
          Register
        </router-link>
      </form>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarText"
        aria-controls="navbarText"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
    </div>
  </nav>
</template>

<style scoped>
.navbar a {
  color: bisque;
}
.navbar img {
  border-radius: 50%;
  width: 30px;
  height: 30px;
  margin-right: 1rem;
}
</style>