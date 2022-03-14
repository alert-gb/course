export default {
    getSections(state) {
        axios.get('/api/sections').then((response) => {
            state.sections = response.data;
        })
    },
    getSectionsLength(state) {
        axios.get('/api/sections').then((response) => {
            
            state.sectionsLength = response.data.length;
        })
    }
}

