import Vue from 'vue';
export default {
    
    // Get all videos
    getSectionVideos(state, slug) {
        axios.get(`/api/section/${slug}/videos`).then((response) => {
            state.videos = response.data;
        });
    },
    
    createSectionVideo(state, payload) {
        axios.post(`/api/section/${payload.slug}/videos`, payload.data);
    },
    updateSectionVideo(state, payload) {
        axios.post(`/api/section/${payload.slug}/videos/update`, payload.data);
    },
    deleteSectionVideo(state, payload) {
        axios.delete(`/api/${payload.id}/videos/delete`);
    },
    
    getVideo(state, id) {
        axios.get(`/api/video/${id}`).then((response) => {
            state.video = response.data;
        });
    },

    getFirstVideo(state, slug) {
        axios.get(`/api/course/${slug}/firstvideo`).then((response) => {
            state.firstVideo = response.data;
        });
    },
    
    getVideosLength(state) {
        axios.get("/api/videos").then((response) => {
            state.videosLength = response.data.length;
        });
    },

}