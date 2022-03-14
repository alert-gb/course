export default {
    
    // Get all videos
    getterSectionVideos(state) {
        return state.videos;
    },

    // Get single video
    getterVideo(state) {
        return state.video;
    },

    getterFirstVideo(state) {
        return state.firstVideo;
    },

    getterVideosLength(state) {
        return state.videosLength;
    },
}