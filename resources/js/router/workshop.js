import store from '../store'
const websiteUrl = "/" + store.getters['auth/user'].uuid
export default [
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
        path: websiteUrl + "/clients/:id",
        name: "clients.show",
        component: () => import('@workshop/Clients/show'),
    },
    {
        path: websiteUrl + "/support",
        name: "support",
        component: () => import('../components/Support.vue'),
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
        component: () => import('../components/Messages.vue'),
    },
    {
        path: websiteUrl + "/calendar",
        name: "calendar",
        component: () => import('../components/Calendar.vue'),
    },
    {
        path: websiteUrl + "/error-report",
        name: "error-report",
        component: () => import('../components/ErrorReport.vue'),
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
    },
    {
        path: websiteUrl + "/workers/:id",
        name: "workers.show",
        component: () => import('@workshop/Workers/workers/show'),
    }
]
