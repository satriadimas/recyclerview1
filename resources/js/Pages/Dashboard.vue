<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-11">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-2 bg-white border-b border-gray-200">
                        <table
                            class="table-fixed w-full text-center border-collapse border border-slate-500"
                        >
                            <thead>
                                <tr>
                                    <th
                                        class="border border-slate-600"
                                        rowspan="2"
                                    >
                                        No
                                    </th>
                                    <th
                                        class="border border-slate-600"
                                        colspan="6"
                                    >
                                        Supplier
                                    </th>
                                    <!-- <th
                                        class="border border-slate-600"
                                        colspan="3"
                                    >
                                        Model
                                    </th> -->
                                    <th
                                        class="border border-slate-600"
                                        rowspan="2"
                                        colspan="3"
                                    >
                                        Rincian
                                    </th>
                                    <th
                                        class="border border-slate-600"
                                        colspan="12"
                                    >
                                        Bulan
                                    </th>
                                </tr>
                                <tr>
                                    <th
                                        class="border border-slate-600"
                                        colspan="2"
                                    >
                                        Nama
                                    </th>
                                    <th
                                        class="border border-slate-600"
                                        colspan="2"
                                    >
                                        Code
                                    </th>
                                    <th
                                        class="border border-slate-600"
                                        colspan="2"
                                    >
                                        Barang
                                    </th>
                                    <th
                                        class="border border-slate-600"
                                        v-for="i in 12"
                                        :key="i"
                                    >
                                        bln {{ i }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        class="border border-slate-700"
                                        rowspan="6"
                                    >
                                        1
                                    </td>
                                    <td
                                        class="border border-slate-700"
                                        rowspan="6"
                                        colspan="2"
                                    >
                                        68305
                                    </td>
                                    <td
                                        class="border border-slate-700"
                                        rowspan="6"
                                        colspan="2"
                                    >
                                        Processor
                                    </td>
                                    <td
                                        class="border border-slate-700"
                                        rowspan="6"
                                        colspan="2"
                                    >
                                        CMK
                                    </td>
                                    <td
                                        class="border border-slate-700"
                                        colspan="3"
                                    >
                                        Qty Ren Prod
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="border border-slate-700"
                                        colspan="3"
                                    >
                                        Qty PO
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="border border-slate-700"
                                        colspan="3"
                                    >
                                        Outsanding
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="border border-slate-700"
                                        colspan="3"
                                    >
                                        Actual Kedatangan
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="border border-slate-700"
                                        colspan="3"
                                    >
                                        Stock
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        class="border border-slate-700"
                                        colspan="3"
                                    >
                                        Standar Stock
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
