export default [
    {
        path: "/:uuid",
        children: [
            {
                path: "/dashboard",
                name: "workshop.dashboard",
                component: () => import('@workshop/Dashboard'),
            },
            {
                path: "/clients",
                name: "workshop.clients",
                component: () => import('@workshop/Clients'),
            },
            {
                path: "/clients/:id",
                name: "workshop.clients.show",
                component: () => import('@workshop/Clients/show'),
            },
            {
                path: "/support",
                name: "workshop.support",
                component: () => import('../components/Support.vue'),
            },
            {
                path: "/documents",
                name: "workshop.documents",
                component: () => import('@workshop/Documents'),
            },
            {
                path: "/repairs",
                name: "workshop.repairs",
                component: () => import('@workshop/Repairs'),
            },
            {
                path: "/messages",
                name: "workshop.messages",
                component: () => import('../components/Messages.vue'),
            },
            {
                path: "/calendar",
                name: "workshop.calendar",
                component: () => import('../components/Calendar.vue'),
            },
            {
                path: "/error-report",
                name: "workshop.error-report",
                component: () => import('../components/ErrorReport.vue'),
            },
            {
                path: "/informations",
                name: "workshop.informations",
                component: () => import('@workshop/Workshop/Information'),
            },
            {
                path: "/settings",
                name: "workshop.settings",
                component: () => import('@workshop/Settings'),
            },
            {
                path: "/workers",
                name: "workshop.workers",
                component: () => import('@workshop/Workers/workers/list'),
            },
            {
                path: "/workers/:id",
                name: "workshop.workers.show",
                component: () => import('@workshop/Workers/workers/show'),
            }
        ]
    },
]
