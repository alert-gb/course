import CourseSectionsMutaions from './mutations.js';
import CourseSectionsActions from './actions.js';
import CourseSectionsGetters from './getters.js';
export default {
    // namespaced: true,
    state() {
        return {
            courseSections: null,
            video1: null,
        }
    },
    mutations: CourseSectionsMutaions,
    actions: CourseSectionsActions,
    getters: CourseSectionsGetters,

};