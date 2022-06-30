<script setup>
import useSupplierGoods from "@/composables/suppliers/detail";
import useBoms from "@/composables/boms";
import useToggleModal from "@/API/toggleModel";

import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted, computed, defineEmits, ref, watch } from "vue";
import { locales } from "moment";

const emit = defineEmits();

const { supplierGoods, getAllSupplierGoods } = useSupplierGoods();
const { errors, data, storeBoms } = useBoms();
const { state, toggleModel } = useToggleModal();

const form = useForm({
    id_product: usePage().props.value.id,
});

function onToggleModal() {
    toggleModel();
    form.reset();
}

const submitProduct = async () => {
    onToggleModal();
    try {
        await storeBoms({ ...form });
        emit("status-data", true);
    } catch (error) {
        console.log(error);
        emit("status-data", false);
    }
};
</script>
<template>
    <div
        class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
    >
        <div class="w-80 p-6 bg-white rounded-md shadow-xl">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl">Add Materials</h3>
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
            <div class="mt-2 mb-6 text-sm text-red-600" v-if="errors !== ''">
                {{ errors }}
            </div>

            <form class="space-y-6" @submit.prevent="submitProduct">
                <div class="space-y-4 rounded-md shadow-sm">
                    <div>
                        <label
                            for="materials"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Materials
                        </label>
                        <div class="mt-1">
                            <Multiselect
                                id="materials"
                                v-model="form.id_supplier_good"
                                mode="tags"
                                placeholder="Choose your stack"
                                :close-on-select="false"
                                :filter-results="false"
                                :min-chars="0"
                                :resolve-on-load="true"
                                :delay="0"
                                :searchable="true"
                                :options="
                                    function (query) {
                                        return getAllSupplierGoods(query); // check JS block in JSFiddle for implementation
                                    }
                                "
                            />
                        </div>
                    </div>
                    <div>
                        <label
                            for="qty"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Qty
                        </label>
                        <div class="mt-1">
                            <input
                                type="text"
                                name="qty"
                                id="qty"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="form.qty"
                            />
                        </div>
                    </div>
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>
