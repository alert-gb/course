<template>
  <video controls :src="'/' + video.video" :poster="'/' + video.photo">
    Sorry, your browser doesn't support embedded videos, but don't worry, you
    can <a href="https://archive.org/details/BigBuckBunny_124">download it</a>
    and watch it with your favorite video player!
  </video>
</template>
<script>
export default {
    props:['video'],
};
</script>
<style scoped>
video {
  width: 100%;
}
</style>