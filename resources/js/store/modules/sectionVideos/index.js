import VideoMutaions from './mutations.js';
import VideoActions from './actions.js';
import VideoGetters from './getters.js';
export default {
    // namespaced: true,
    state() {
        return {
            videos: null,
            video: null,
            firstVideo: null,
            videosLength: null,
        }
    },
    mutations: VideoMutaions,
    actions: VideoActions,
    getters: VideoGetters,

};