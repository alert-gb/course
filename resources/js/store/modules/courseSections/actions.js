export default {
    getCourseSections({commit}, slug) {
        commit('getCourseSections', slug);
    },
    createCourseSection(context, payload) {
        context.commit('createCourseSections', payload);
    },
    updateCourseSection(context, payload) {
        context.commit('updateCourseSection', payload);
    },
    deleteCourseSection(context, payload) {
        context.commit('deleteCourseSection', payload);
    },
}