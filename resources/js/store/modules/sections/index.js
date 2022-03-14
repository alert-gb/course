import sectionsMutations from './mutations.js';
import sectionsActions from './actions.js';
import sectionsGetters from './getters.js';

export default {
    state() {
        return {
            sections: null,
            sectionsLength: 0,
            
        }
    },
    mutations: sectionsMutations,
    actions: sectionsActions,
    getters: sectionsGetters,
}