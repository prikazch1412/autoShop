import Vue from "vue";
import Router from "vue-router";
import store from './store';

import Index from './views/site/Index';
import Services from './views/site/Services';
import News from './views/site/News';
import NewsView from './views/site/NewsView';
import ServiceView from './views/site/ServiceView';
import Profile from './views/site/Profile';
import Favorites from './views/site/Favorites';
import ErrorComponent from './views/ErrorComponent.vue';

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
            component: Services,
            props: route => ({ query: route.query })
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
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/security', // профиль безопасность
            name: 'profile-security',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/services', // профиль сервисы
            name: 'profile-services',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/photo', // профиль photo
            name: 'profile-photo',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/reviews', // профиль reviews
            name: 'profile-reviews',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/orders', // профиль orders
            name: 'profile-orders',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/cars', // профиль cars
            name: 'profile-cars',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/chats', // профиль chats
            name: 'profile-chats',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/chat/:id', // профиль chat
            name: 'profile-chat-id',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/profile/service-cars', // профиль chat
            name: 'profile-service-cars',
            component: Profile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/favorites', // избраннве
            name: 'favorites',
            component: Favorites,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: '/*',
            name: 'error',
            component: ErrorComponent,
        },
    ]
})

router.beforeEach((to, from, next) => {
    if(to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
        } else {
            next('/');
        }
    } else {
        if((to.name == 'login' || to.name == 'register') && store.getters.isLoggedIn) {
            next({
                path: '/profile',
                params: { nextUrl: to.fullPath }
            });
        } else {
            next();
        }
    }
})

export default router;
