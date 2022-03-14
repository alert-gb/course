export default {
    async getCategories(context) {
        const response = await axios.get('/api/categories');
        context.commit('getCategories', response.data);
    },
    
    async getCategoriesLength(context) {
        const response = await axios.get('/api/categories');
        context.commit('getCategoriesLength', response.data.length);
    },

    async createCategory(context, payload) {
        await axios.post('/api/categories/store', payload);
        context.commit('createCategory', payload);
    },
    async updateCategory(context, payload) {
        await axios.post(`/api/categories/${payload.id}/update`, payload.data);
        context.commit('updateCategory', payload);
    },
    async deleteCategory(context, payload) {
        await axios.delete(`/api/categories/${payload}/delete`);
        context.commit('deleteCategory', payload);
    }
}