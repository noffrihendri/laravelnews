import VueRouter from 'vue-router';
import Camera from './components/camera';
import Login from './components/login';
import App from './components/App';
import Navbar from './components/navbar';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/Camera',
            name: 'Camera',
            component: Camera, 
        },
        {
            path: '/',
            name: 'Home',
            component: App, 
        },
         {
            path: '/Login',
            name: 'Login',
            component: Login, 
        },

    ],
});

// router.beforeEach((to, from, next) => {
//   // redirect to login page if not logged in and trying to access a restricted page
//   const publicPages = ['/'];
//   const authRequired = !publicPages.includes(to.path);
//   const loggedIn = localStorage.getItem('token');

//   if (authRequired && !loggedIn) {
//     return next('/');
//   }

//   next();
// })


export default router;