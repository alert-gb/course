import categoryMutaions from './mutations.js';
import categoryActions from './actions.js';
import categoryGetters from './getters.js';
export default {
    state() {
        return {
            id: null,
            category: null,
            categories: null,
            categoriesLength: 0,
            
        }
    },
    mutations: categoryMutaions,
    actions: categoryActions,
    getters: categoryGetters,

};