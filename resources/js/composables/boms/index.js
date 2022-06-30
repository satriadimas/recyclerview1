import { ref } from "vue";
import axios from "axios";

export default function useProducts() {
    const data = ref([]);

    const errors = ref("");

    const getBomDetail = async (id) => {
        let response = await axios.get(`/api/bom/${id}/detail`);
        data.value = response.data.data;
    };

    const storeBoms = async (data) => {
        errors.value = "";
        await axios.post("/api/bom", data);
    };

    const destroyBom = async (id) => {
        await axios.delete(`/api/bom/${id}`);
    };

    return {
        errors,
        data,
        getBomDetail,
        storeBoms,
        destroyBom,
    };
}
