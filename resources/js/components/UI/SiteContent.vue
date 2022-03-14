<template>
    <the-header></the-header>
    <div class="py-5 bg-light">
    <div class="container">
      <div class="row">
          <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
import TheHeader from './TheHeader.vue'
export default {
  components: {
    TheHeader,
  }
}
</script>