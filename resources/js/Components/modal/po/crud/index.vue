<template>
    <div
        class="absolute inset-0 flex items-start pt-10 justify-center bg-gray-700 bg-opacity-50"
    >
        <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl">Add Po</h3>
                <svg
                    @click="onToggleModal"
                    xmlns="http://www.w3.org/2000/svg"
                    class="w-8 h-8 text-red-900 cursor-pointer"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"
                    />
                </svg>
            </div>

            <form class="space-y-2 mt-4">
                <div class="space-y-4 rounded-md shadow-sm">
                    <div>
                        <label
                            for="supplier"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Supplier
                        </label>
                        <div class="mt-1">
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
                    </div>
                </div>
                <div class="flex justify-end mt-0">
                    <div
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-green-800 rounded-md border border-transparent ring-green-300 transition duration-150 ease-in-out hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring disabled:opacity-25 cursor-pointer"
                    >
                        Add
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2 mt-0">
                    <div class="space-y-4 rounded-md shadow-sm">
                        <div>
                            <label
                                for="material"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Material
                            </label>
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="material"
                                    id="material"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 rounded-md shadow-sm">
                        <div>
                            <label
                                for="qty"
                                class="block text-sm font-medium text-gray-700"
                                >Qty</label
                            >
                            <div class="mt-1">
                                <input
                                    type="text"
                                    name="qty"
                                    id="qty"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4 rounded-md shadow-sm">
                        <div>
                            <label
                                for="order_date"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Order Date
                            </label>
                            <div class="mt-1">
                                <Datepicker
                                    v-model="param.date"
                                    :enableTimePicker="false"
                                ></Datepicker>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import useToggleModal from "@/API/toggleModel";
import useSuppliers from "@/composables/suppliers";
import { ref } from "vue";

const { state, toggleModel } = useToggleModal();

const { getSupplierOptions } = useSuppliers();

function onToggleModal() {
    toggleModel();
}

const param = ref({
    supplier_id: null,
    date: null,
});
</script>

<style lang="scss" scoped></style>
