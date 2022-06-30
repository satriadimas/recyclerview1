import { ref } from "vue";
import axios from "axios";

export default function useSuppliers() {
    const supplier = ref([]);
    const suppliers = ref([]);

    const errors = ref("");

    const getSuppliers = async () => {
        let response = await axios.get("/api/suppliers");
        suppliers.value = response.data.data;
    };

    const getSupplier = async (id) => {
        let response = await axios.get(`/api/suppliers/${id}`);
        supplier.value = response.data.data;
    };

    const getSupplierOptions = async (search) => {
        let response = await axios.get(
            `/api/supplier/options?search=${search ? search : ""}`
        );
        return response.data;
    };

    const searchSupplier = async (param) => {
        let response = await axios.get(`/api/suppliers?search=${param.search}`);
        return response.data.data;
    };

    const storeSupplier = async (data) => {
        errors.value = "";
        await axios.post("/api/suppliers", data);
    };

    const updateSupplier = async (id) => {
        errors.value = "";
        await axios.patch(`/api/suppliers/${id}`, supplier.value);
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
        getSupplierOptions,
    };
}
