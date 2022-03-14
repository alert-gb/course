export default {
    getCategories(state, payload) {
        state.categories = payload;
    },
    
    getCategoriesLength(state, payload) {
        state.categoriesLength = payload;
    },

    createCategory(state, payload) {
        state.categories.push(payload);
    },

    updateCategory(state, payload) {
        state.categories.push(payload);
    },

    deleteCategory(state, payload) {
        const index = state.categories.indexOf((category) => category.id = payload)
        state.categories.splice()
    }
}