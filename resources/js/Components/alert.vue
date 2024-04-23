<script setup>
import { onMounted, ref, defineProps } from "vue";

const props = defineProps({
    alertBg: {
        type: String,
        required: true,
    },
    message: {
        type: String,
        required: true,
    },
    show: {
        type: Boolean,
    },
});

const alertTrue = ref(props.show);
const removeAlert = () => {
    alertTrue.value = false;
};

onMounted(() => {
    console.warn(props.show ,"azeem-alert")
    setTimeout(() => {
        alertTrue.value = false;
    }, 2000);
});
</script>

<template>
    <div
        v-if="alertTrue"
        class="p-2 px-4 rounded max-w-[500px] flex items-center justify-between gap-1 absolute w-full z-20 start-1/2 -translate-x-1/2 mt-3"
        :class="`${alertBg}`"
    >
        <p>{{ message }}</p>
        <span
            role="button"
            class="flex items-center justify-center animate-bounce"
            @click="removeAlert(this)"
        >
            <i class="pi pi-times-circle"></i>
        </span>
    </div>
</template>
