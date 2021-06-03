import VueRouter from "vue-router";
import Vue from "vue";
import mainWrapper from './components/v-mainwrapper'
import articlesWrapper from './components/v-news'


Vue.use(VueRouter);

const routes = [
    {
        path:'/',
        component:mainWrapper,
        name:'home'
    },
    {
        path:'/articles',
        component: articlesWrapper,
        name: 'articles'
    }

]

export default new VueRouter({
    mode:"history",
    routes
})