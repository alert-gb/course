export default {
    getCourses(state) {
        axios.get('/api/courses').then((response) => {
            state.courses = response.data;
        });
    },
    getCoursesLength(state) {
        axios.get('/api/courses').then((response) => {
            state.coursesLength = response.data.length;
        });
    }
}
