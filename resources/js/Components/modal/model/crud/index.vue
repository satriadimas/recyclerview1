<script setup>
import useProduct from "@/composables/products";
import useToggleModal from "@/API/toggleModel";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import { onMounted, computed, defineEmits } from "vue";

const emit = defineEmits();

const props = defineProps({
    id: {
        default: null,
    },
});

const { errors, product, storeProduct, updateProduct, getProduct } =
    useProduct();
const { state, toggleModel } = useToggleModal();

const title = computed(() => (props.id ? "Edit Product" : "Add Product"));
const button = computed(() => (props.id ? "Update" : "Create"));

const form = useForm({});

if (props.id) {
    onMounted(() => getProduct(props.id));
}

function onToggleModal() {
    toggleModel();
    form.reset();
}

const submitProduct = async () => {
    onToggleModal();
    if (!props.id) {
        try {
            await storeProduct({ ...form });
            emit("status-data", true, true);
        } catch (error) {
            console.log(error);
            emit("status-data", true, false);
        }
    }

    if (props.id) {
        try {
            await updateProduct(props.id);
            emit("status-data", false, true);
        } catch (error) {
            console.log(error);
            emit("status-data", false, false);
        }
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

            <form class="space-y-6" @submit.prevent="submitProduct">
                <div class="space-y-4 rounded-md shadow-sm">
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
                                v-model="product.name"
                            />
                            <input
                                v-else
                                type="text"
                                name="name"
                                id="name"
                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                v-model="form.name"
                            />
                        </div>
                    </div>
                </div>

                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25"
                >
                    {{ button }}
                </button>
            </form>
        </div>
    </div>
</template>
