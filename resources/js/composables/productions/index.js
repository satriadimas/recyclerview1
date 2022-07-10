import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default function useProductions() {
    const production = ref([]);
    const productions = ref([]);
    const pos = ref([]);

    const errors = ref("");
    const router = useRouter();

    const getCalPos = async (id, date) => {
        let response = await axios.get(
            `/api/calculation/po/${id}?year=${date}`
        );
        pos.value = response.data;
    };

    const getPos = async () => {
        let response = await axios.get(`/api/po`);
        pos.value = response.data.data;
    };

    const getPoDetail = async (id) => {
        let response = await axios.get(`/api/po/detail/${id}`);
        return response.data.data;
    };

    const generatePdf = async (id) => {
        await axios.get(`/api/generate-pdf/${id}`);
        return;
    };

    const eMrp = async (data) => {
        await axios.post(`/api/mrp-pdf`, { ...data });
        return;
    };

    const storePo = async (data) => {
        errors.value = "";

        await axios.post(`/api/po`, data);
    };

    const searchPos = async (param) => {
        let response = await axios.get(`/api/po?search=${param.search}`);
        return response.data.data;
    };

    const getProductions = async () => {
        let response = await axios.get("/api/production");
        productions.value = response.data.data;
    };

    const getProduction = async (id) => {
        let response = await axios.get(`/api/production/${id}`);
        production.value = response.data.data;
    };

    const searchProduction = async (param) => {
        let response = await axios.get(
            `/api/production?search=${param.search}`
        );
        return response.data.data;
    };

    const storeProduction = async (data) => {
        errors.value = "";
        await axios.post("/api/production", data);
    };

    const destroyProduction = async (id) => {
        await axios.delete(`/api/production/${id}`);
    };

    return {
        pos,
        errors,
        production,
        productions,
        eMrp,
        getPos,
        getPoDetail,
        storePo,
        searchPos,
        getCalPos,
        getProduction,
        getProductions,
        searchProduction,
        storeProduction,
        destroyProduction,
        generatePdf,
    };
}
