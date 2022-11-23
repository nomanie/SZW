import VueRouter from "vue-router";

const routes = [
    {
        path: "/dashboard",
        name: "dashboard",
        component: () => import('../views/workshop/components/Dashboard'),
    },
    {
        path: "/clients",
        name: "clients",
        component: () => import('../views/workshop/components/Clients'),
    },
    {
        path: "/support",
        name: "support",
        component: () => import('./components/Support'),
    },
    {
        path: "/documents",
        name: "documents",
        component: () => import('../views/workshop/components/Documents'),
    },
    {
        path: "/repairs",
        name: "repairs",
        component: () => import('../views/workshop/components/Repairs'),
    },
    {
        path: "/messages",
        name: "messages",
        component: () => import('./components/Messages'),
    },
    {
        path: "/calendar",
        name: "calendar",
        component: () => import('./components/Calendar'),
    },
    {
        path: "/error-report",
        name: "error-report",
        component: () => import('./components/ErrorReport'),
    },
    {
        path: "/informations",
        name: "informations",
        component: () => import('../views/workshop/components/Workshop/Information'),
    },
    {
        path: "/settings",
        name: "settings",
        component: () => import('../views/workshop/components/Settings'),
    },
    {
        path: "/workers",
        name: "workers",
        component: () => import('../views/workshop/components/Workers/workers/list'),
    },
]

const router = new VueRouter({
    routes,
    mode: 'history'
})


export default router
