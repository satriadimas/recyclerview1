import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useSuppliers() {
    const supplier = ref([]);
    const suppliers = ref([]);

    const errors = ref("");
    const router = useRouter();

    const getSuppliers = async () => {
        let response = await axios.get("/api/suppliers");
        suppliers.value = response.data.data;
    };

    const getSupplier = async (id) => {
        let response = await axios.get(`/api/suppliers/${id}`);
        supplier.value = response.data.data;
    };

    const searchSupplier = async (param) => {
        let response = await axios.get(`/api/suppliers?search=${param.search}`);
        return response.data.data;
    };

    const storeSupplier = async (data) => {
        errors.value = "";
        try {
            await axios.post("/api/suppliers", data);
            router.go();
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + " ";
                }
            }
        }
    };

    const updateSupplier = async (id) => {
        errors.value = "";
        try {
            await axios.patch(`/api/suppliers/${id}`, supplier.value);
            router.go();
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + " ";
                }
            }
        }
    };

    const destroySupplier = async (id) => {
        await axios.delete(`/api/suppliers/${id}`);
    };

    return {
        errors,
        supplier,
        suppliers,
        getSupplier,
        getSuppliers,
        searchSupplier,
        storeSupplier,
        updateSupplier,
        destroySupplier,
    };
}
