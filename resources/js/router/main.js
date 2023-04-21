import VueRouter from "vue-router";
import workshop from "./workshop";
import auth from "./auth";

const router = new VueRouter({
    routes: [
        ...auth,
        ...workshop,
    ],
    mode: 'history'
})


export default router
