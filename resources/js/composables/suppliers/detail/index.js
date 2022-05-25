import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useSuppliers() {
    const supplierGood = ref([]);
    const supplierGoods = ref([]);

    const errors = ref("");
    const router = useRouter();

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
        try {
            await axios.post("/api/supplier-goods", data);
            router.go();
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + " ";
                }
            }
        }
    };

    const updateSupplierGood = async (id) => {
        errors.value = "";
        try {
            await axios.patch(`/api/supplier-goods/${id}`, supplierGood.value);
            router.go();
        } catch (e) {
            if (e.response.status === 422) {
                for (const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + " ";
                }
            }
        }
    };

    const destroySupplierGood = async (id) => {
        await axios.delete(`/api/supplier-goods/${id}`);
    };

    return {
        errors,
        supplierGood,
        supplierGoods,
        getSupplierGood,
        getSupplierGoods,
        searchSupplierGood,
        storeSupplierGood,
        updateSupplierGood,
        destroySupplierGood,
    };
}
