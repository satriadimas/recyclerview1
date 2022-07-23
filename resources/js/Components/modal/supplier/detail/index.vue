<script setup>
import useSupplierGood from "@/composables/suppliers/detail";
import useToggleModal from "@/API/toggleModel";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, computed, watch, defineEmits, ref } from "vue";

const emit = defineEmits();

const props = defineProps({
    id: {
        default: null,
    },
    currency: {
        default: null,
    },
    supplier_id: {
        default: null,
    },
    supplier_name: {
        default: null,
    },
});

const {
    errors,
    supplierGood,
    storeSupplierGood,
    updateSupplierGood,
    getSupplierGood,
} = useSupplierGood();
const { state, toggleModel } = useToggleModal();

const title = computed(() => (props.id ? "Edit Barang" : "Add Barang"));
const button = computed(() => (props.id ? "Update" : "Create"));

function uuid() {
    const name = props.supplier_name.split(" ");
    const initial = `${name[0].charAt(0)}${name[1] ? name[1].charAt(0) : ""}${
        name[2] ? name[2].charAt(0) : ""
    }`;
    return `${initial}-xxxx-xxxx`.replace(/[xy]/g, function (c) {
        var r = (Math.random() * 16) | 0,
            v = c == "x" ? r : (r & 0x3) | 0x8;
        return v.toString(16);
    });
}

const form = ref({
    code: uuid(),
    supplier_id: props.supplier_id,
});

if (props.id) {
    onMounted(() => getSupplierGood(props.id));
}

function onToggleModal() {
    toggleModel();
    // form.reset();
}

const submitSupplierGood = async () => {
    onToggleModal();
    try {
        if (!props.id) await storeSupplierGood({ ...form.value });
        if (props.id) await updateSupplierGood(props.id);

        emit("status-data", !props.id, true);
    } catch (error) {
        console.log(error);
        emit("status-data", !props.id, false);
    }
};
</script>
<template>
    <div
        class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
    >
        <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
            <div class="flex items-center justify-between">
                <h3 class="text-2xl">{{ title }}</h3>
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

            <form class="space-y-6" @submit.prevent="submitSupplierGood">
                <div class="space-y-4 rounded-md shadow-sm">
                    <div>
                        <label
                            for="code"
                            class="block text-sm font-medium text-gray-700"
                            >Code</label
                        >
                        <div class="mt-1">
                            <input
                                v-if="props.id"
                                type="text"
                                name="code"
                                id="code"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="supplierGood.code"
                            />
                            <input
                                v-else
                                type="text"
                                name="code"
                                id="code"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="form.code"
                            />
                        </div>
                    </div>
                    <div>
                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700"
                            >Name</label
                        >
                        <div class="mt-1">
                            <input
                                v-if="props.id"
                                type="text"
                                name="name"
                                id="name"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="supplierGood.name"
                            />
                            <input
                                v-else
                                type="text"
                                name="name"
                                id="name"
                                placeholder="Isi nama barang"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="form.name"
                            />
                        </div>
                    </div>
                    <div class="columns-2">
                        <div>
                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700"
                                >Price</label
                            >
                            <div class="mt-1">
                                <input
                                    v-if="props.id"
                                    type="text"
                                    name="price"
                                    id="price"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="supplierGood.price"
                                />
                                <input
                                    v-else
                                    type="text"
                                    name="price"
                                    id="price"
                                    placeholder="Isi harga"
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    v-model="form.price"
                                />
                            </div>
                        </div>

                        <div>
                            <label
                                for="currency"
                                class="block text-sm font-medium text-gray-700"
                                >currency</label
                            >
                            <div class="mt-1">
                                <input
                                    type="text"
                                    disabled
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    :value="props.currency"
                                />
                            </div>
                        </div>
                    </div>
                    <div>
                        <label
                            for="unit"
                            class="block text-sm font-medium text-gray-700"
                            >Unit</label
                        >
                        <div class="mt-1">
                            <select
                                v-if="props.id"
                                name="unit"
                                id="unit"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="supplierGood.unit"
                            >
                                <option value="pcs">PCS</option>
                                <option value="kg">KG</option>
                                <option value="can">CAN</option>
                            </select>
                            <select
                                v-else
                                name="unit"
                                id="unit"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="form.unit"
                            >
                                <option value="pcs">PCS</option>
                                <option value="kg">KG</option>
                                <option value="can">CAN</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                    >
                        {{ button }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
