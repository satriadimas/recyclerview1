import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            count: 0,
            menus: [
                { href: "dashboard", name: "Dashboard" },
                { href: "po", name: "PO" },
                { href: "production", name: "Production" },
                // { href: "bom", name: "BOM" },
                { href: "supplier", name: "Supplier" },
                { href: "model", name: "Model" },
            ],
        };
    },
    mutations: {
        increment(state) {
            state.count++;
        },
    },
});

export { store };
