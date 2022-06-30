import { ref } from "vue";
import axios from "axios";

export default function useWarehouse() {
    const stock = ref([]);
    const incoming = ref([]);
    const outgoing = ref([]);

    const getStock = async (param) => {
        let response = await axios.get(
            `/api/warehouse/stock?supplier_id=${param.supplier_id}&search=${param.search}`
        );
        stock.value = response.data.data;
    };

    const addIncoming = async (data) => {
        await axios.post("/api/warehouse/incoming/add", data);
    };

    const addOutgoing = async (data) => {
        await axios.post("/api/warehouse/outgoing/add", data);
    };

    const getIncoming = async (param) => {
        let response = await axios.get(
            `/api/warehouse/incoming?supplier_id=${param.supplier_id}&search=${param.search}`
        );
        incoming.value = response.data.data;
    };

    const getOutgoing = async (param) => {
        let response = await axios.get(
            `/api/warehouse/outgoing?supplier_id=${param.supplier_id}&search=${param.search}`
        );
        outgoing.value = response.data.data;
    };

    const destroy = async (type, id) => {
        if (type === "incoming") {
            await axios.delete(`/api/warehouse/incoming/${id}`);
        } else {
            await axios.delete(`/api/warehouse/outgoing/${id}`);
        }
    };

    return {
        stock,
        incoming,
        outgoing,
        getStock,
        addIncoming,
        getIncoming,
        addOutgoing,
        getOutgoing,
        destroy,
    };
}
