export default [
    {
        path: "/login",
        name: "login",
        component: () => import('../../views/auth/components/login.vue'),
    },
    {
        path: "/register",
        name: "register",
        component: () => import('../../views/auth/components/register.vue'),
    },
    {
        path: "/register/workshop",
        name: "register.workshop",
        component: () => import('../../views/auth/components/partials/workshop.vue'),
    },
    {
        path: "/register/client",
        name: "register.client",
        component: () => import('../../views/auth/components/partials/client.vue'),
    },
    {
        path: "/changePassword",
        name: "change_password",
        component: () => import('../../views/auth/components/changePassword.vue'),
    },
    {
        path: "/login/2fa",
        name: "2fa",
        component: () => import('../../views/auth/components/2fa.vue'),
    },
    {
        path: "/email/verify/:id/:token",
        name: "verify_mail",
        component: () => import('../../views/auth/components/login.vue'),
    },
]
