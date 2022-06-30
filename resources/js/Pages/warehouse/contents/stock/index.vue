<script setup>
import warehouse from "../../index";
import useSuppliers from "@/composables/suppliers";
import useWarehouse from "@/composables/warehouse";
import { reactive, watch } from "vue";

const { getSupplierOptions } = useSuppliers();
const { stock, getStock } = useWarehouse();

const params = reactive({
    supplier_id: null,
    search: "",
});

watch(params, async (param) => {
    try {
        await getStock(param);
    } catch (error) {
        console.log(error);
    }
});
</script>
<template>
    <warehouse label="Stock">
        <div class="flex flex-col gap-4">
            <div class="grid grid-cols-2">
                <div class="flex justify-start">
                    <Multiselect
                        id="supplier"
                        placeholder="Cari Supplier"
                        v-model="params.supplier_id"
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
                <div class="flex justify-end">
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                        >
                            <svg
                                class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </div>
                        <input
                            v-model="params.search"
                            type="text"
                            id="table-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search for material"
                        />
                    </div>
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table
                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                >
                    <thead
                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                    >
                        <tr>
                            <th scope="col" class="px-6 py-3">No.</th>
                            <th scope="col" class="px-6 py-3">Materials</th>
                            <th scope="col" class="px-6 py-3">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(val, i) in stock"
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
                                {{ val.name }}
                            </th>
                            <th
                                scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                            >
                                {{ val.stock }}
                            </th>
                        </tr>

                        <tr v-if="!stock.length">
                            <td colspan="5" class="px-6 py-4 text-center">
                                Belum ada data
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </warehouse>
</template>

<style lang="scss" scoped></style>
