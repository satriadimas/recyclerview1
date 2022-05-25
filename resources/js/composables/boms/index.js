import { ref } from "vue";
import axios from "axios";

export default function useProducts() {
    const data = ref([]);

    const errors = ref("");

    const getBomDetail = async (id) => {
        let response = await axios.get(`/api/bom/${id}/detail`);
        data.value = response.data.data;
    };

    return {
        errors,
        data,
        getBomDetail,
    };
}
