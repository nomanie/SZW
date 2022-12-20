import VueRouter from "vue-router";
const websiteUrl = "/" + localStorage.getItem('id')
const routes = [
    {
        path: websiteUrl + "/dashboard",
        name: "dashboard",
        component: () => import('@workshop/Dashboard'),
    },
    {
        path: websiteUrl + "/clients",
        name: "clients",
        component: () => import('@workshop/Clients'),
    },
    {
        path: websiteUrl + "/support",
        name: "support",
        component: () => import('../components/Support'),
    },
    {
        path: websiteUrl + "/documents",
        name: "documents",
        component: () => import('@workshop/Documents'),
    },
    {
        path: websiteUrl + "/repairs",
        name: "repairs",
        component: () => import('@workshop/Repairs'),
    },
    {
        path: websiteUrl + "/messages",
        name: "messages",
        component: () => import('../components/Messages'),
    },
    {
        path: websiteUrl + "/calendar",
        name: "calendar",
        component: () => import('../components/Calendar'),
    },
    {
        path: websiteUrl + "/error-report",
        name: "error-report",
        component: () => import('../components/ErrorReport'),
    },
    {
        path: websiteUrl + "/informations",
        name: "informations",
        component: () => import('@workshop/Workshop/Information'),
    },
    {
        path: websiteUrl + "/settings",
        name: "settings",
        component: () => import('@workshop/Settings'),
    },
    {
        path: websiteUrl + "/workers",
        name: "workers",
        component: () => import('@workshop/Workers/workers/list'),
    }
]

const router = new VueRouter({
    routes,
    mode: 'history'
})


export default router
