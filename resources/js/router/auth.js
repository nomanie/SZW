export default [
    {
        path: "/login",
        name: "login",
        meta: {auth: false},
        component: () => import('../../views/auth/components/login.vue'),
    },
    {
        path: "/register",
        name: "register",
        meta: {auth: false},
        component: () => import('../../views/auth/components/register.vue'),
    },
    {
        path: "/register/workshop",
        name: "register.workshop",
        meta: {auth: false},
        component: () => import('../../views/auth/components/partials/workshop.vue'),
    },
    {
        path: "/register/client",
        name: "register.client",
        meta: {auth: false},
        component: () => import('../../views/auth/components/partials/client.vue'),
    },
    {
        path: "/changePassword",
        name: "change_password",
        meta: {auth: false},
        component: () => import('../../views/auth/components/changePassword.vue'),
    },
    {
        path: "/login/2fa",
        name: "2fa",
        meta: {auth: '2fa'},
        component: () => import('../../views/auth/components/2fa.vue'),
    },
    {
        path: "/email/verify/:id/:token",
        name: "verify_mail",
        meta: {auth: false},
        component: () => import('../../views/auth/components/login.vue'),
    },
]
