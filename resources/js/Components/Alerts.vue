<script setup>
import useToggleModal from "@/API/toggleModel";

const { toggleModel } = useToggleModal();

const props = defineProps({
    status: {
        default: null,
    },
    message: {
        default: null,
    },
});
</script>
<template>
    <div
        class="alert flex flex-row items-center p-2 rounded border-b-2 my-3 relative"
        :class="
            status === 'Success'
                ? 'bg-green-200 text-teal-200 border-teal-300'
                : 'bg-red-200 text-red-200 border-red-300'
        "
    >
        <div
            class="alert-icon flex items-center justify-center h-10 w-10 flex-shrink-0 rounded-full"
            :class="
                status === 'Success'
                    ? 'text-teal-100 border-teal-500'
                    : 'text-red-100 border-red-500'
            "
        >
            <span v-if="status === 'Success'" class="text-green-500">
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path
                        fill-rule="evenodd"
                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </span>
            <span v-else class="text-red-500">
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </span>
        </div>
        <div class="alert-content ml-4">
            <div
                class="alert-title font-semibold text-lg"
                :class="status === 'Success' ? 'text-teal-800' : 'text-red-800'"
            >
                {{ props.status }}
            </div>
            <div
                class="alert-description text-sm"
                :class="status === 'Success' ? 'text-teal-600' : 'text-red-600'"
            >
                {{ props.message }}
            </div>
        </div>

        <span
            @click="toggleModel"
            class="absolute top-0 bottom-0 right-0 px-4 py-3"
        >
            <svg
                class="fill-current h-6 w-6 text-black"
                role="button"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
            >
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"
                />
            </svg>
        </span>
    </div>
</template>
