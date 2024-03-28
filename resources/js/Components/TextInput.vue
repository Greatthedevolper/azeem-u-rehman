<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="border-gray-300 dark:border-gray-700 bg-white text-gray-900 focus:border-grayy-900  focus:ring-gray-900 rounded-md shadow-sm"
        v-model="model"
        ref="input"
    />
</template>
