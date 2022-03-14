export default {
    getCourseSections(state, slug) {
        axios.get(`/api/course/${slug}`).then((response) => {
            state.CourseSections = response.data;
            
        });
    },
    createCourseSections(state, payload) {
        axios.post(`/api/course/${payload.slug}`, payload.data)
    },
    updateCourseSection(state, payload) {
        axios.post(`/api/course/${payload.slug}`, payload.data)
    },
    deleteCourseSection(state, payload) {
        axios.delete(`/api/section/${payload.id}`);
    }
    
}