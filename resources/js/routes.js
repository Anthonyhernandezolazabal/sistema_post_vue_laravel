import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

export const rutas = [
    {
        path: "/",
        name: "dashboard.index",
        component: require("./components/modulos/Dashboard/index.vue").default,
    },
    {
        path: "/usuarios",
        name: "usuarios.index",
        component: require("./components/modulos/Usuarios/index.vue").default,
    },
    {
        path: "/categorias",
        name: "categorias.index",
        component: require("./components/modulos/Categorias/index.vue").default,
    },
    {
        path: "/marcas",
        name: "marcas.index",
        component: require("./components/modulos/Marcas/index.vue").default,
    },
    {
        path: "/clientes",
        name: "clientes.index",
        component: require("./components/modulos/Clientes/index.vue").default,
    },
    {
        path: "/clientes/crear-cliente",
        name: "clientes.create",
        component: require("./components/modulos/Clientes/create.vue").default,
    },
    {
        path: "/clientes/editar-cliente/:id",
        name: "clientes.edit",
        component: require("./components/modulos/Clientes/edit.vue").default,
    },

]

export default new VueRouter({
    routes:rutas,
    mode: "history",
    linkExactActiveClass: 'active' //Activar el módulo donde estoy
    // linkActiveClass: 'active' //El módulo se mantenga seleccionado
})
