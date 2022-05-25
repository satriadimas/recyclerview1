import { createRouter, createWebHistory } from "vue-router";
import Model from "@/Pages/model";
const routes = [
    {
        path: "/model",
        name: "Model",
        component: Model,
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
