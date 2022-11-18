import VueRouter from "vue-router";

const routes = [
    {
        path: "/dashboard",
        name: "dashboard",
        component: () => import('./components/workshop/Dashboard'),
    },
    {
        path: "/clients",
        name: "clients",
        component: () => import('./components/workshop/Clients'),
    },
    {
        path: "/support",
        name: "support",
        component: () => import('./components/Support'),
    },
    {
        path: "/documents",
        name: "documents",
        component: () => import('./components/workshop/Documents'),
    },
    {
        path: "/repairs",
        name: "repairs",
        component: () => import('./components/workshop/Repairs'),
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
        component: () => import('./components/workshop/Workshop/Information'),
    },
    {
        path: "/settings",
        name: "settings",
        component: () => import('./components/workshop/Settings'),
    },
    {
        path: "/workers",
        name: "workers",
        component: () => import('./components/workshop/Workers/workers/list'),
    },
]

const router = new VueRouter({
    routes
})


export default router
