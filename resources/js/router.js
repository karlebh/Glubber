import { createRouter, createWebHistory } from "vue-router"
import Cookies from "js-cookie"

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: "/",
            name: "login",
            component: () => import("./Pages/Login.vue"),
        },
        {
            path: "/index",
            name: "index",
            component: () => import("./Pages/Landing.vue"),
        },
        {
            path: "/find-ride",
            name: "find-ride",
            component: () => import("./Pages/FindRide.vue"),
        },
        {
            path: "/drive",
            name: "drive",
            component: () => import("./Pages/Drive.vue"),
        },
        {
            path: "/create-driver",
            name: "create-driver",
            component: () => import("./Pages/CreateDriver.vue"),
        },
        {
            path: "/stand-by",
            name: "stand-by",
            component: () => import("./Pages/StandBy.vue"),
        },

        {
            path: "/map",
            name: "map",
            component: () => import("./Pages/Map.vue"),
        },
        {
            path: "/trip",
            name: "trip",
            component: () => import("./Pages/Trip.vue"),
        },
        {
            path: "/:pathMatch(.*)",
            name: "not-found",
            component: () => import("./Pages/NotFound.vue"),
        },
    ],
})

function authenticated() {
    return Cookies.get("token")
}

router.beforeEach((to, from, next) => {
    if (authenticated() && to.name === "login") next({ name: "index" })
    else if (!authenticated() && to.name === "index") next({ name: "login" })
    else next()
})

export default router
