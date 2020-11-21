import Vue from "vue";
import Router from "vue-router";
import store from './store';

import Index from './views/site/Index';
import Services from './views/site/Services';
import News from './views/site/News';
import NewsView from './views/site/NewsView';
import ServiceView from './views/site/ServiceView';
import Profile from './views/site/Profile';

Vue.use(Router);

let router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/', // главга
            name: 'index',
            component: Index
        },
        {
            path: '/services', // сервисы
            name: 'services',
            component: Services
        },
        {
            path: '/service/:id', // сервис
            name: 'service-view',
            component: ServiceView
        },
        {
            path: '/service/:id/reviews', // сервис отзывы
            name: 'service-view-reviews',
            component: ServiceView
        },
        {
            path: '/service/:id/photo', // сервис фото
            name: 'service-view-photo',
            component: ServiceView
        },
        {
            path: '/service/:id/address', // сервис адрес
            name: 'service-view-address',
            component: ServiceView
        },
        {
            path: '/news', // новости
            name: 'news',
            component: News
        },
        {
            path: '/news/:id', // новость
            name: 'news-view',
            component: NewsView
        },
        {
            path: '/profile', // профиль
            name: 'profile',
            component: Profile
        },
        {
            path: '/profile/security', // профиль безопасность
            name: 'profile-security',
            component: Profile
        },
        {
            path: '/profile/services', // профиль сервисы
            name: 'profile-services',
            component: Profile
        },
        {
            path: '/profile/photo', // профиль photo
            name: 'profile-photo',
            component: Profile
        },
        {
            path: '/profile/reviews', // профиль reviews
            name: 'profile-reviews',
            component: Profile
        },
        {
            path: '/profile/orders', // профиль orders
            name: 'profile-orders',
            component: Profile
        },
        {
            path: '/profile/cars', // профиль cars
            name: 'profile-cars',
            component: Profile
        },
        {
            path: '/profile/chats', // профиль chats
            name: 'profile-chats',
            component: Profile
        },
        {
            path: '/profile/chat/:id', // профиль chat
            name: 'profile-chat-id',
            component: Profile
        },
    ]
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
        } else {
            next('/login');
        }
    } else {
        if((to.name == 'index' || to.name == 'login' || to.name == 'register') && store.getters.isLoggedIn) {
            next({
                path: '/cabinet',
                params: { nextUrl: to.fullPath }
            });
        } else {
            next();
        }
    }
})

export default router;
