<script setup>
import useProducts from "@/composables/products";
import useProductions from "@/composables/productions";
import useToggleModal from "@/API/toggleModel";
import { useRouter } from "vue-router";

import { Head, Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { onMounted, computed, defineEmits, ref, watch } from "vue";
import { locales } from "moment";

const emit = defineEmits();

const { getProductOptions } = useProducts();
const { storeProduction } = useProductions();
const { state, toggleModel } = useToggleModal();
const router = useRouter();

const form = useForm({});

function onToggleModal() {
    toggleModel();
    form.reset();
}

const setDate = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    form.date = `${year}-${month}-${day}`;
};

const submitData = async () => {
    const countData = form.id_product.length;
    const countQty = form.qty.length;
    if (countData === countQty) {
        onToggleModal();
        try {
            await storeProduction({ ...form });
            emit("status-data", true);
        } catch (error) {
            emit("status-data", false);
        }
    } else {
        if (!window.alert("Model dan qty tidak sesuai!")) {
            return;
        }
    }
};
</script>
<template>
    <div
        class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
    >
        <div class="w-80 p-6 bg-white rounded-md shadow-xl">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl">Add Production</h3>
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

            <form class="space-y-6" @submit.prevent="submitData">
                <div class="space-y-4 rounded-md shadow-sm">
                    <div>
                        <label
                            for="model"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Model
                        </label>
                        <div class="mt-1">
                            <Multiselect
                                id="model"
                                mode="tags"
                                placeholder="Pilih model"
                                v-model="form.id_product"
                                :close-on-select="false"
                                :filter-results="false"
                                :min-chars="0"
                                :resolve-on-load="true"
                                :delay="0"
                                :searchable="true"
                                :options="
                                    function (query) {
                                        return getProductOptions(query); // check JS block in JSFiddle for implementation
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
                            <Multiselect
                                id="materials"
                                v-model="form.qty"
                                mode="tags"
                                placeholder="Input Qty Produksi"
                                :options="[]"
                                :create-option="true"
                                :searchable="true"
                                :regex="/\d/"
                                inputType="number"
                            />
                        </div>
                    </div>
                    <div>
                        <label
                            for="date"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Date
                        </label>
                        <div class="mt-1">
                            <Datepicker
                                v-model="form.date"
                                :enableTimePicker="false"
                                :modelValue="form.date"
                                @update:modelValue="setDate"
                            ></Datepicker>
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
