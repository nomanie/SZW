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
    const auth = store.getters["auth/user"]
    const logged = store.getters["auth/authenticated"];
    const prefix = auth.is_admin ? 'admin' : (auth.type === 'workshop' ? 'workshop' : (auth.type === 'client' ? 'client' : null))
    if (to.meta.auth === true && logged === false) {
        console.log(1)
        // niezalogowany próbuje dostać się na route dla zalogowanych, redirect to login
        next("/login");
    } else if (logged === '2fa' || logged === 'must_2fa') {
        if (to.name === '2fa') {
            next()
        } else {
            next({name: '2fa'})
        }
    } else if (!to.meta.auth && logged === false) {
        console.log(3)
        // niezalogowany próbuje dostać się na route dla guesta, redirect
        next()
    } else if (!to.meta.auth && logged === 'logged') {
        console.log(4)
        //zalogowany próbuje dostać się na routy guesta, redirect to dashboard
        next({name: prefix + '.dashboard', params: {uuid: auth.uuid}})
    } else {
        if (to.meta.type === prefix) {
            // sprawdzamy czy zgadza się uuid strony
            if (to.path.split('/')[1] === auth.uuid) {
                console.log(5)
                next()
            } else {
                console.log(6)
                next({name: prefix + '.dashboard', params: {uuid: auth.uuid}})
            }
        } else {
            console.log(7)
            next({name: prefix + '.dashboard', params: {uuid: auth.uuid}})
        }
    }
});

export default router
