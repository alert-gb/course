export default {
    // Getting all vidoes
    getSectionVideos(context, slug) {
        context.commit('getSectionVideos', slug);
    },
    createSectionVideo(context, payload) {
        context.commit('createSectionVideo', payload);
    },
    updateSectionVideo(context, payload) {
        context.commit('updateSectionVideo', payload);
    },
    deleteSectionVideo(context, payload) {
        context.commit('deleteSectionVideo', payload);
    },
//     // Getting single section Video
    getVideo(context, id) {
        context.commit('getVideo', id);
    },
    getFirstVideo(context, slug) {
        context.commit('getFirstVideo', slug);
    },
    getVideosLength(context) {
        context.commit('getVideosLength');
    }
}