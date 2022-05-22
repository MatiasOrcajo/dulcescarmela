const Home = ()=> import('./components/Home.vue');
const Categories = ()=> import('./components/Categories.vue');


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'categories',
        path: '/categories',
        component: Categories
    },
]