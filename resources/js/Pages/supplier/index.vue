<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ModalSupplier from "@/Components/modal/supplier/crud/index.vue";
import useSuppliers from "@/composables/suppliers";
import useToggleModal from "@/API/toggleModel";
import { onMounted, reactive, ref, watch } from "vue";

const { openModal, hasRole } = useToggleModal();
const edited = ref();
const onToggleModal = (role) => {
    openModal(role);
};

const { suppliers, getSuppliers, searchSupplier, destroySupplier } =
    useSuppliers();

onMounted(getSuppliers);

const myAlert = reactive({
    show: false,
    status: "Success",
    message: null,
    color: "teal",
});

const params = reactive({
    search: null,
});

watch(params, async (param) => {
    try {
        const res = await searchSupplier(param);
        suppliers.value = res;
    } catch (error) {
        console.log(error);
    }
});

const editeSupplier = (id) => {
    edited.value = id;
    onToggleModal("ModalEditSupplier");
};

const statusData = async (addOrEdit, val) => {
    myAlert.message = addOrEdit ? "Input Data" : "Update Data";
    myAlert.status = val ? "Success" : "Whoops, something went wrong";
    onToggleModal("myAlert");
    await getSuppliers();
};

const deleteSupplier = async (id) => {
    if (!window.confirm("You sure?")) {
        return;
    }

    await destroySupplier(id);
    await getSuppliers();
};
</script>

<template>
    <Head title="Supplier" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Supplier
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
                        <div class="grid grid-cols-2 mb-4">
                            <div class="flex justify-start">
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
                                        placeholder="Search for suppliers"
                                    />
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button
                                    @click="onToggleModal('ModalAddSupplier')"
                                    type="button"
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                >
                                    Add Supplier
                                </button>
                            </div>
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
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Address
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Contact
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(item, i) in suppliers"
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
                                            {{ item.address }}
                                        </th>
                                        <th
                                            scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                                        >
                                            {{ item.contact }}
                                        </th>
                                        <td
                                            class="grid grid-cols-3 px-6 py-4 text-right"
                                        >
                                            <Link
                                                class="mr-2 inline-flex items-center px-4 py-2 bg-cyan-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                :href="
                                                    route('supplier-goods', {
                                                        id: item.id,
                                                    })
                                                "
                                            >
                                                Materials
                                            </Link>

                                            <button
                                                @click="editeSupplier(item.id)"
                                                class="mr-2 inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            >
                                                Update
                                            </button>

                                            <button
                                                @click="deleteSupplier(item.id)"
                                                class="mr-2 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>

                                    <tr v-if="!suppliers.length">
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
        <modal-supplier
            @status-data="statusData"
            v-if="hasRole('ModalAddSupplier')"
        />
        <modal-supplier
            @status-data="statusData"
            :id="edited"
            v-if="hasRole('ModalEditSupplier')"
        />
    </BreezeAuthenticatedLayout>
</template>
