<template>
    <Head title="Warehouse" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <div class="grid grid-cols-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Warehouse || {{ label }}
                </h2>
                <div
                    class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex justify-end"
                >
                    <BreezeNavLink
                        :href="route('stock')"
                        :active="route().current('stock')"
                    >
                        Stock
                    </BreezeNavLink>
                    <BreezeNavLink
                        :href="route('incoming')"
                        :active="route().current('incoming')"
                    >
                        Incoming
                    </BreezeNavLink>
                    <BreezeNavLink
                        :href="route('outgoing')"
                        :active="route().current('outgoing')"
                    >
                        Outgoing
                    </BreezeNavLink>
                </div>
            </div>
        </template>

        <div class="py-11">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white border-b border-gray-200">
                        <div
                            v-if="label === null"
                            class="text-center font-bold font-serif"
                        >
                            Silahkan Pilih Menu
                        </div>
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    label: {
        default: null,
    },
});
</script>

<style lang="scss" scoped></style>
