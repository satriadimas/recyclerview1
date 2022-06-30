<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import useToggleModal from "@/API/toggleModel";
import useSuppliers from "@/composables/suppliers";
import useSupplierGoods from "@/composables/suppliers/detail";
import useProductions from "@/composables/productions";
import moment from "moment";
import { useRouter } from "vue-router";
import { ref, reactive, watch } from "vue";

const { state, toggleModel } = useToggleModal();

const { getSupplierOptions } = useSuppliers();

const { optionSupplierGoods } = useSupplierGoods();

const { storePo } = useProductions();

const router = useRouter();

function onToggleModal() {
    toggleModel();
}

function addField(fieldType) {
    fieldType.push({ material: "", qty: "", date: "" });
}

function removeField(index, fieldType) {
    fieldType.splice(index, 1);
}

const formInput = ref([{ material: "", qty: "", date: "" }]);

const supplier_id = ref();

const param = reactive({
    po_code: uuid(),
    terms: null,
});

const clearForm = () => {
    formInput.value = [{ material: "", qty: "", date: "" }];
};

const format = (date) => {
    const day = date.getDate();
    const month = date.getMonth() + 1;
    const year = date.getFullYear();

    return `${year}-${month}-${day}`;
};

function uuid() {
    const initial = "SDI";
    return `${initial}-xxxxx`.replace(/[xy]/g, function (c) {
        var r = (Math.random() * 16) | 0,
            v = c == "x" ? r : (r & 0x3) | 0x8;
        return v.toString(16);
    });
}

const submitData = async () => {
    const data = {
        code: param.po_code,
        terms: param.terms,
        data: formInput.value,
    };
    try {
        await storePo(data);
        clearForm();
        router.go();
    } catch (error) {
        console.log(error);
    }
};
</script>
<template>
    <Head title="PO" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Purchase Order's
            </h2>
        </template>

        <div class="py-11">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <form
                            class="space-y-2 mt-4"
                            @submit.prevent="submitData"
                        >
                            <div class="grid grid-cols-3 gap-2 mt-0">
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
                                                v-model="supplier_id"
                                                @clear="clearForm"
                                                :close-on-select="true"
                                                :filter-results="false"
                                                :min-chars="0"
                                                :resolve-on-load="false"
                                                :delay="3"
                                                :searchable="true"
                                                :options="
                                                    function (query) {
                                                        return getSupplierOptions(
                                                            query
                                                        ); // check JS block in JSFiddle for implementation
                                                    }
                                                "
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4 rounded-md shadow-sm">
                                    <div>
                                        <label
                                            for="po_code"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            PO Code
                                        </label>
                                        <div class="mt-1">
                                            <input
                                                v-model="param.po_code"
                                                type="text"
                                                name="po_code"
                                                id="po_code"
                                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-4 rounded-md shadow-sm">
                                    <div>
                                        <label
                                            for="terms"
                                            class="block text-sm font-medium text-gray-700"
                                        >
                                            Terms
                                        </label>
                                        <div class="mt-1">
                                            <input
                                                v-model="param.terms"
                                                type="text"
                                                name="terms"
                                                id="terms"
                                                class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end mt-0">
                                <!--Add Svg Icon-->
                                <svg
                                    @click="addField(formInput)"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    width="24"
                                    height="24"
                                    class="ml-2 cursor-pointer"
                                >
                                    <path fill="none" d="M0 0h24v24H0z" />
                                    <path
                                        fill="green"
                                        d="M11 11V7h2v4h4v2h-4v4h-2v-4H7v-2h4zm1 11C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"
                                    />
                                </svg>
                            </div>
                            <div class="grid grid-cols-3 gap-2 mt-0">
                                <div class="space-y-4">
                                    <label
                                        for="material"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Material
                                    </label>
                                </div>
                                <div class="space-y-4">
                                    <label
                                        for="delivery_date"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Delivery Date
                                    </label>
                                </div>
                                <div class="space-y-4">
                                    <label
                                        for="qty"
                                        class="block text-sm font-medium text-gray-700"
                                    >
                                        Qty
                                    </label>
                                </div>
                            </div>
                            <div
                                class="grid grid-cols-3 gap-2 mt-0"
                                v-for="(input, index) in formInput"
                                :key="`formInput-${index}`"
                            >
                                <div class="space-y-4 rounded-md shadow-sm">
                                    <div class="mt-1">
                                        <Multiselect
                                            id="materials"
                                            v-model="input.material"
                                            placeholder="Choose material"
                                            :close-on-select="true"
                                            :filter-results="false"
                                            :min-chars="0"
                                            :resolve-on-load="false"
                                            :delay="3"
                                            :searchable="true"
                                            :options="
                                                function (query) {
                                                    return optionSupplierGoods(
                                                        supplier_id,
                                                        query
                                                    ); // check JS block in JSFiddle for implementation
                                                }
                                            "
                                        />
                                    </div>
                                </div>
                                <div class="space-y-4 rounded-md shadow-sm">
                                    <div class="mt-1">
                                        <input
                                            v-model="input.date"
                                            type="date"
                                            name="date"
                                            id="date"
                                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        />
                                    </div>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="space-y-4 rounded-md shadow-sm">
                                        <input
                                            v-model="input.qty"
                                            type="text"
                                            name="qty"
                                            id="qty"
                                            class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        />
                                    </div>
                                    <!--Remove Svg Icon-->
                                    <svg
                                        v-show="formInput.length > 1"
                                        @click="removeField(index, formInput)"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        width="24"
                                        height="24"
                                        class="ml-2 cursor-pointer"
                                    >
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path
                                            fill="#EC4899"
                                            d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z"
                                        />
                                    </svg>
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
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<style lang="scss" scoped></style>
