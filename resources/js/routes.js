import { createRouter, createWebHistory } from 'vue-router';
import TheCategories from './components/site/TheCategories.vue';
import CategoryCourses from './components/site/CategoryCourses.vue';
import NotFound from './components/UI/NotFound.vue';
import TheCourse from './components/site/TheCourse.vue';
import CourseVideo from './components/site/CourseVideo.vue';
// Admin
import AdminDashboard from './components/admin/AdminDashboard.vue';
import AdminCategories from './components/admin/categories/AdminCategories.vue';
import AdminCategoryCourses from './components/admin/categories/courses/AdminCategoryCourses.vue';
import AdminSections from './components/admin/categories/courses/sections/AdminSections.vue';
import AdminVideos from './components/admin/categories/courses/sections/videos/AdminVideos.vue';
import TheLogin from './components/admin/auth/TheLogin.vue';
import TheRegister from './components/admin/auth/TheRegister.vue';

const routes = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/register', component: TheRegister, meta: {authPage: true}},
        {path: '/login', component: TheLogin, meta: {authPage: true}},
        // Site Routes
        {path: '/', redirect: '/categories'},
        {path: '/categories', component: TheCategories},
        {name:'categorycourses', path: '/category/' + ':categorySlug' + '/courses', component: CategoryCourses},
        {
            name:'course',
            path: '/course/' + ':courseSlug',
            component: TheCourse,
        },
        
        // Admin
        {path: '/admin', component: AdminDashboard, meta: {needsAuth: true}},
        {path: '/admin/categories', component: AdminCategories, meta: {needsAuth: true}},
        {name:'adminCategoryCourses', path: '/admin/category/' + ':adminCategorySlug' + '/courses', component: AdminCategoryCourses, meta: {needsAuth: true}},
        {name:'adminSections', path: '/admin/course/' + ':adminCourseSlug' + '/sections', component: AdminSections, meta: {needsAuth: true}},
        {name:'adminSectionVideo', path: '/admin/section/' + ':adminSectionSlug' + '/videos', component: AdminVideos, meta: {needsAuth: true}},

        {name: 'notFound', path: '/:notFound(.*)', component: NotFound},
    ],
});
function isAuth() {
    return localStorage.getItem('token');
}
routes.beforeEach((to, from, next) => {
    // check if the to is "admin"
    if(to.meta.needsAuth) {
        // check if the user is authenticated
        if(isAuth()) {
            next();
        // check if the user is not authenticated
        } else {
            next({
                path: '/notfound',
            })
        }
    } else if(to.meta.authPage) {
        if(isAuth()) {
            next({
                path: '/categories',
            })
        }
    }
    next();
})
export default routes;