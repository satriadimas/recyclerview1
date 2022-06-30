import { createStore } from "vuex";

const store = createStore({
    state() {
        return {
            count: 0,
            menus: [
                // { href: "dashboard", name: "Dashboard" },
                { href: "po", name: "PO" },
                { href: "mrp", name: "MRP" },
                { href: "production", name: "Planning Production" },
                // { href: "bom", name: "BOM" },
                { href: "warehouse", name: "Gudang" },
                { href: "supplier", name: "Supplier" },
                { href: "model", name: "BOM" },
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
