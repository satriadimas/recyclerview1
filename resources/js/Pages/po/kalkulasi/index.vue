<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import useSuppliers from "@/composables/suppliers";
import useProductions from "@/composables/productions";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";
import moment from "moment";

const { getSupplierOptions } = useSuppliers();

const { pos, getCalPos, eMrp } = useProductions();

const param = ref({
    supplier_id: null,
    date: null,
});

const isDisable = computed(() => {
    return !param.value.supplier_id || !param.value.date;
});

const searchData = async () => {
    await getCalPos(param.value.supplier_id, param.value.date);
};

const generatePdf = async () => {
    await eMrp(param.value.supplier_id, param.value.date);
};
</script>

<template>
    <Head title="MRP" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Material Requirements Planning
            </h2>
        </template>

        <div class="py-11">
            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <button
                        v-if="pos.length"
                        @click="generatePdf()"
                        type="button"
                        class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        Print
                    </button>
                </div>
                <div class="flex justify-end mb-4 gap-4">
                    <div class="w-1/4">
                        <Multiselect
                            id="supplier"
                            placeholder="Cari Supplier"
                            v-model="param.supplier_id"
                            :close-on-select="false"
                            :filter-results="false"
                            :min-chars="0"
                            :resolve-on-load="true"
                            :delay="0"
                            :searchable="true"
                            :options="
                                function (query) {
                                    return getSupplierOptions(query); // check JS block in JSFiddle for implementation
                                }
                            "
                        />
                    </div>
                    <div class="w-1/4">
                        <Datepicker
                            v-model="param.date"
                            :enableTimePicker="false"
                            yearPicker
                        ></Datepicker>
                    </div>
                    <div class="min-w-max">
                        <button
                            @click="searchData()"
                            :disabled="isDisable"
                            :class="{
                                'opacity-25 cursor-not-allowed': isDisable,
                            }"
                            type="button"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                        >
                            Calculate
                        </button>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">No.</th>
                                    <th scope="col" class="px-6 py-3">
                                        Barang
                                    </th>
                                    <th scope="col" class="px-6 py-3"></th>
                                    <th
                                        scope="col"
                                        v-for="a in 12"
                                        class="px-6 py-3"
                                    >
                                        {{
                                            moment("2022")
                                                .add(a - 1, "month")
                                                .format("MMM")
                                        }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(val, i) in pos"
                                    :key="i"
                                    class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700"
                                >
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ i + 1 }}
                                    </th>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        {{ val.material }}
                                    </th>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                    >
                                        <ul>
                                            <li class="text-green-300">
                                                Rencana Produksi
                                            </li>
                                            <li class="text-red-400">
                                                Rencana Po
                                            </li>
                                            <li class="text-red-300">Qty Po</li>
                                            <li class="text-purple-300">
                                                Outstanding Po
                                            </li>
                                            <li class="text-yellow-300">
                                                Actual Kedatangan
                                            </li>
                                            <li class="text-blue-300">Stock</li>
                                            <li class="text-gray-300">
                                                Standar Stock
                                            </li>
                                        </ul>
                                    </th>
                                    <th
                                        scope="col"
                                        v-for="(m, i) in val.month"
                                        class="px-6 py-3"
                                    >
                                        <ul class="text-center">
                                            <li class="text-green-300">
                                                {{ m.production }}
                                            </li>
                                            <li class="text-red-300">
                                                {{ m.rencana_po }}
                                            </li>
                                            <li class="text-red-300">
                                                {{ m.qty_po }}
                                            </li>
                                            <li class="text-purple-300">
                                                {{ m.outstanding }}
                                            </li>
                                            <li class="text-yellow-300">
                                                {{ m.incoming }}
                                            </li>
                                            <li class="text-blue-300">
                                                {{ m.stock }}
                                            </li>
                                            <li class="text-gray-300">
                                                {{ m.standar_stock }}
                                            </li>
                                        </ul>
                                    </th>
                                </tr>
                                <tr v-if="!pos.length">
                                    <td
                                        colspan="15"
                                        class="px-6 py-4 text-center"
                                    >
                                        Belum ada data
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
