import VueRouter from 'vue-router'

let routes = [
    {
        path: '/manage',
        component: require('./components/admin/pages/Home')
    },
    {
        path: '/about',
        component: require('./components/admin/pages/About')
    },
    {
        path: '/topics/:id',
        name: 'topics',
        component: require('./components/admin/topics/Topic')
    }
];

export default new VueRouter({
    mode: 'history',
    routes
})