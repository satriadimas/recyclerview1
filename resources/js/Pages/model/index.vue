<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ModalProduct from "@/Components/modal/model/crud/index.vue";
import useProducts from "@/composables/products";
import useToggleModal from "@/API/toggleModel";
import { onMounted, reactive, ref, watch } from "vue";

const { products, getProducts, searchProduct, destroyProduct } = useProducts();

const { openModal, hasRole } = useToggleModal();

onMounted(getProducts);

const edited = ref();

const params = reactive({
    search: null,
});

watch(params, async (param) => {
    try {
        const res = await searchProduct(param);
        products.value = res;
    } catch (error) {
        console.log(error);
    }
});

const editeProduct = (id) => {
    edited.value = id;
    onToggleModal("ModalEdit");
};

const onToggleModal = (role) => {
    openModal(role);
};

const deleteProduct = async (id) => {
    if (!window.confirm("You sure?")) {
        return;
    }

    await destroyProduct(id);
    await getProducts();
};
</script>

<template>
    <Head title="Models" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Models
            </h2>
        </template>

        <div class="py-11">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between">
                    <div class="p-4">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mt-1">
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
                                placeholder="Search for products"
                            />
                        </div>
                    </div>
                    <div class="p-4">
                        <label for="table-add" class="sr-only">Add</label>
                        <button
                            type="button"
                            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            @click="onToggleModal('ModalAdd')"
                        >
                            Add Model
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
                                        Model name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, i) in products"
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
                                        {{ item.name }}
                                    </th>
                                    <td class="px-6 py-4 text-right">
                                        <Link
                                            class="mr-2 inline-flex items-center px-4 py-2 bg-cyan-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            :href="
                                                route('bom-detail', {
                                                    id: item.id,
                                                })
                                            "
                                        >
                                            BOM
                                        </Link>
                                        <button
                                            @click="editeProduct(item.id)"
                                            class="mr-2 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        >
                                            Update
                                        </button>

                                        <button
                                            @click="deleteProduct(item.id)"
                                            class="mr-2 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                        >
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="!products.length">
                                    <td
                                        colspan="3"
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
        <modal-product v-if="hasRole('ModalAdd')" />
        <modal-product :id="edited" v-if="hasRole('ModalEdit')" />
    </BreezeAuthenticatedLayout>
</template>
