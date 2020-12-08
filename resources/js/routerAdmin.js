import Vue from 'vue'
import Router from 'vue-router'

// admin components
import Users from './views/admin/Users.vue';
import Services from './views/admin/Services.vue';
import Orders from './views/admin/Orders.vue';
import News from './views/admin/News.vue';
import AddNews from './views/admin/AddNews.vue';

Vue.use(Router);

let router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
    routes: [
        {
            path: '/admin',
            name: 'users',
            component: Users
        },
        {
            path: '/admin/services',
            name: 'services',
            component: Services
        },
        {
            path: '/admin/orders',
            name: 'orders',
            component: Orders
        },
        {
            path: '/admin/news',
            name: 'news',
            component: News
        },
        {
            path: '/admin/news/:id',
            name: 'edit-news',
            component: AddNews
        },
        {
            path: '/admin/add-news',
            name: 'add-news',
            component: AddNews
        }
    ]
  })

export default router
