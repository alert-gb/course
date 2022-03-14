export default {
    getCategoryCourses(state, slug) {
        axios
        .get(`/api/categories/${slug}/courses`)
        .then((response) => {state.categoryCourses = response.data});
    },
    createCategoryCourse(state, payload) {
        axios.post(`/api/categories/${payload.slug}/courses/store`, payload.data);
    },

    updateCategoryCourse(state, payload) {
        axios.post(`/api/categories/${payload.slug}/courses/update`, payload.data);
    },
    
    deleteCategoryCourse(state, id) {
        axios.delete(`/api/categories/courses/${id}/delete`);
    },
}