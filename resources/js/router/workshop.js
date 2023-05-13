import store from "../store";

export default [
    {
        path: "/:uuid",
        component: () => import('@root/main'),
        meta: {
            token: store.state.auth.user.token
        },
        children: [
            {
                path: "dashboard",
                name: "workshop.dashboard",
                component: () => import('@workshop/Dashboard'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "clients",
                name: "workshop.clients",
                component: () => import('@workshop/Clients'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
                children: [
                    {
                        path: ":id",
                        component: () => import('@workshop/Clients/show'),
                        meta: {
                            auth: true,
                            type: 'workshop'
                        },
                        children: [
                            {
                                path: "",
                                name: "workshop.clients.data",
                                component: () => import('@workshop/Clients/tabs/info'),
                                meta: {
                                    auth: true,
                                    type: 'workshop'
                                },
                            },
                            {
                                path: "cars",
                                name: "workshop.clients.cars",
                                component: () => import('@workshop/Clients/tabs/cars/list'),
                                meta: {
                                    auth: true,
                                    type: 'workshop'
                                },
                            },
                            {
                                path: "documents",
                                name: "workshop.clients.documents",
                                component: () => import('@workshop/Clients/tabs/documents/list'),
                                meta: {
                                    auth: true,
                                    type: 'workshop'
                                },
                            }
                        ]
                    }
                ]
            },
            {
                path: "support",
                name: "workshop.support",
                component: () => import('../components/Support.vue'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "documents",
                name: "workshop.documents",
                component: () => import('@workshop/Documents'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "repairs",
                name: "workshop.repairs",
                component: () => import('@workshop/Repairs'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "messages",
                name: "workshop.messages",
                component: () => import('../components/Messages.vue'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "calendar",
                name: "workshop.calendar",
                component: () => import('../components/Calendar.vue'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "error-report",
                name: "workshop.error-report",
                component: () => import('../components/ErrorReport.vue'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "informations",
                name: "workshop.informations",
                component: () => import('@workshop/Workshop/Information'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "settings",
                name: "workshop.settings",
                component: () => import('@workshop/Settings'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "workers",
                name: "workshop.workers",
                component: () => import('@workshop/Workers/workers/list'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            },
            {
                path: "workers/:id",
                name: "workshop.workers.show",
                component: () => import('@workshop/Workers/workers/show'),
                meta: {
                    auth: true,
                    type: 'workshop'
                },
            }
        ]
    },
]
