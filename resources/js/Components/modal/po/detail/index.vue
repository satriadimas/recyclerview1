<script setup>
import useToggleModal from "@/API/toggleModel";
import moment from "moment";
import { ref } from "vue";

const { state, toggleModel } = useToggleModal();

function onToggleModal() {
    toggleModel();
}

const props = defineProps({
    po: {
        default: null,
    },
    poList: {
        default: null,
    },
});

const total = ref(0);
const currency = ref();

props.poList.forEach((el) => {
    total.value += parseInt(el.price * el.qty);
    currency.value = el.currency;
});

const currencyFormat = (currency, number) => {
    let type;
    if (currency === "IDR") type = "id-ID";
    if (currency === "USD") type = "en-US";
    if (currency === "JPY") type = "ja-JP";

    return new Intl.NumberFormat(type, {
        style: "currency",
        currency: currency,
    }).format(number);
};
</script>
<template>
    <div
        class="absolute inset-0 flex items-center justify-center bg-gray-700 bg-opacity-50"
    >
        <div class="max-w-2xl p-6 bg-white rounded-md shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-2xl">
                        Detail PO {{ props.po.suplier_name }}
                    </h3>
                    <h3 class="text-base">PO Code {{ props.po.po_code }}</h3>
                </div>
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
            <table
                class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-5"
            >
                <thead
                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                >
                    <tr>
                        <th scope="col" class="px-6 py-3">No.</th>
                        <th scope="col" class="px-6 py-3">Materials</th>
                        <th scope="col" class="px-6 py-3">Qty</th>
                        <th scope="col" class="px-6 py-3">Delivery Date</th>
                        <th scope="col" class="px-6 py-3">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(val, i) in poList"
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
                            {{ val.name }}
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                        >
                            {{ val.qty }}
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                        >
                            {{ moment(val.delivery_date).format("D, MMM YY") }}
                        </th>
                        <th
                            scope="row"
                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"
                        >
                            {{
                                currencyFormat(
                                    val.currency,
                                    val.price * val.qty
                                )
                            }}
                        </th>
                    </tr>

                    <tr
                        v-if="poList"
                        class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700"
                    >
                        <td
                            colspan="4"
                            class="px-6 py-4 font-bold text-gray-900 dark:text-white whitespace-nowrap text-center"
                        >
                            Total Harga
                        </td>
                        <td
                            colspan="1"
                            class="px-6 py-4 font-bold text-gray-900 dark:text-white whitespace-nowrap"
                        >
                            {{ currencyFormat(currency, total) }}
                        </td>
                    </tr>

                    <tr v-if="!poList">
                        <td colspan="5" class="px-6 py-4 text-center">
                            Belum ada data
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
