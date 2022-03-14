import categoryCoursesMutaions from './mutations.js';
import categoryCoursesActions from './actions.js';
import categoryCoursesGetters from './getters.js';
export default {
    // namespaced: true,
    state() {
        return {
            categoryCourses: null,
        }
    },
    mutations: categoryCoursesMutaions,
    actions: categoryCoursesActions,
    getters: categoryCoursesGetters,

};