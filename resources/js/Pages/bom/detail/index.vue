<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import ModalBom from "@/Components/modal/bom/crud/index.vue";
import useToggleModal from "@/API/toggleModel";
import useBoms from "@/composables/boms";
import useProducts from "@/composables/products";
import useSupplierGoods from "@/composables/suppliers/detail";
import { onMounted, reactive, ref, watch } from "vue";

const { product, getProduct } = useProducts();

const { data, getBomDetail, destroyBom } = useBoms();
const { supplierGoods, getSupplierGoods } = useSupplierGoods();

const { openModal, hasRole } = useToggleModal();

const onToggleModal = (role) => {
    openModal(role);
};

const product_id = ref();

const myAlert = reactive({
    status: "Success",
    message: null,
});

async function init() {
    product_id.value = usePage().props.value.id;

    await getBomDetail(product_id.value);
    await getProduct(product_id.value);
}

const statusData = (val) => {
    myAlert.status = val ? "Success" : "Failed";
    myAlert.message = "Input Data";
    onToggleModal("myAlert");
    getBomDetail(product_id.value);
};

const deleteBom = async (id) => {
    if (!window.confirm("You sure?")) {
        return;
    }

    await destroyBom(id);
    await getBomDetail(product_id.value);
};

onMounted(init());
</script>
<template>
    <Head title="Detail" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                BOM's {{ product.name }}
            </h2>
        </template>

        <div class="py-11">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <alerts
                            v-if="hasRole('myAlert')"
                            :status="myAlert.status"
                            :message="myAlert.message"
                        />
                        <div class="flex justify-end mb-4">
                            <label for="table-add" class="sr-only">Add</label>
                            <button
                                @click="onToggleModal('ModalBom')"
                                type="button"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                            >
                                Add Materials
                            </button>
                        </div>
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
                                        <th scope="col" class="px-6 py-3">
                                            No.
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Supplier
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Produk Supllier
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Qty
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(item, i) in data.suppliers"
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
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{ item.barang }}
                                        </th>
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{ item.qty }}
                                        </th>
                                        <td class="px-6 py-4 text-right">
                                            <button
                                                @click="deleteBom(item.id)"
                                                class="mr-2 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="!data.suppliers">
                                        <td
                                            colspan="5"
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
        </div>
        <modal-bom @status-data="statusData" v-if="hasRole('ModalBom')" />
    </BreezeAuthenticatedLayout>
</template>
