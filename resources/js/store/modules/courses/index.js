import coursesMutations from './mutations.js';
import coursesActions from './actions.js';
import coursesGetters from './getters.js';

export default {
    state() {
        return {
            courses: null,
            coursesLength: 0,
        }
    },
    mutations: coursesMutations,
    getters: coursesGetters,
    actions: coursesActions,
}