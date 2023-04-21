import VueRouter from "vue-router";
import workshop from "./workshop";
import auth from "./auth";
import store from "../store";

const router = new VueRouter({
    routes: [
        ...auth,
        ...workshop,
    ],
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    const workshop = store.getters["auth/user"].type === 'workshop'
    const admin = store.getters["auth/user"].is_admin
    const logged = store.getters["auth/authenticated"];

    if (!workshop && !logged) {
        next("/login");
    } else if (admin) {
        next("/admin/dashboard");
    }  else {
        next();
    }
});

export default router
