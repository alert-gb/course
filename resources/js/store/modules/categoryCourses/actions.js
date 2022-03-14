export default {
    getCategoryCourses(context, slug) {
        
        context.commit('getCategoryCourses', slug);
    },
    createCategoryCourse(context, payload) {
        context.commit('createCategoryCourse', payload);
    },
    updateCategoryCourse(context, payload) {
        context.commit('updateCategoryCourse', payload);
    },
    deleteCategoryCourse(context, id) {
        context.commit('deleteCategoryCourse', id);
    }
}