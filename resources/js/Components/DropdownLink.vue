<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full  text-start font-semibold text-gray-300 hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-600 px-2 py-1 transition duration-150 ease-in-out"
    >
        <slot />
    </Link>
</template>
