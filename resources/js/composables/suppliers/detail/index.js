import { ref } from "vue";
import axios from "axios";

export default function useSuppliers() {
    const supplierGood = ref([]);
    const supplierGoods = ref([]);

    const errors = ref("");

    const getAllSupplierGoods = async (search) => {
        let response = await axios.get(
            `/api/supplier-goods?search=${search ? search : ""}`
        );
        return response.data.data;
    };

    const optionSupplierGoods = async (id, search) => {
        let response = await axios.get(
            `/api/material/options?id=${id}&search=${search ? search : ""}`
        );
        return response.data.data;
    };

    const getSupplierGoods = async (supplier_id) => {
        let response = await axios.get(
            `/api/supplier-goods?supplier_id=${supplier_id}`
        );
        supplierGoods.value = response.data.data;
    };

    const getSupplierGood = async (id) => {
        let response = await axios.get(`/api/supplier-goods/${id}`);
        supplierGood.value = response.data.data;
    };

    const searchSupplierGood = async (supplier_id, param) => {
        let response = await axios.get(
            `/api/supplier-goods?supplier_id=${supplier_id}&search=${param.search}`
        );
        return response.data.data;
    };

    const storeSupplierGood = async (data) => {
        errors.value = "";
        await axios.post("/api/supplier-goods", data);
    };

    const updateSupplierGood = async (id) => {
        errors.value = "";
        await axios.patch(`/api/supplier-goods/${id}`, supplierGood.value);
    };

    const destroySupplierGood = async (id) => {
        await axios.delete(`/api/supplier-goods/${id}`);
    };

    return {
        errors,
        supplierGood,
        supplierGoods,
        getAllSupplierGoods,
        optionSupplierGoods,
        getSupplierGood,
        getSupplierGoods,
        searchSupplierGood,
        storeSupplierGood,
        updateSupplierGood,
        destroySupplierGood,
    };
}
