import { createStore } from "vuex";
import RootMutations from './mutations.js';
import RootActions from './actions.js';
import RootGetters from './getters.js';
// Modules
import categoriesModule from './modules/categories/index.js';
import categoryCoursesModule from './modules/categoryCourses/index.js';
import courseSectionsModule from './modules/courseSections/index.js';
import sectionVideosModule from './modules/sectionVideos/index.js'

// import VideoModule from './modules/video/index.js';
import CoursesModule from './modules/courses/index.js';
import sectionsModule from './modules/sections/index.js';

const store = createStore({
    namespaced: true,
    modules: {
        categories: categoriesModule,
        categoryCourses: categoryCoursesModule,
        courseSections: courseSectionsModule,
        sectionVideos: sectionVideosModule,
        // video: VideoModule,
        courses: CoursesModule,
        sections: sectionsModule,
    },
    state() {
        return {

        }
    },
    mutations: RootMutations,
    actions: RootActions,
    getters: RootGetters,
 });

 export default store;