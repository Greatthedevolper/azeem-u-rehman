<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { ref, onMounted, defineProps, defineExpose } from "vue";
import { usePage } from '@inertiajs/inertia-vue3'
const props = defineProps({
    flash:Object,
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },

});
const { message, error, page } = usePage().props
const showMessage = ref('')
onMounted(() => {
    console.log(props.flash.message);
    if (props.flash.message) {
        showMessage.value=props.flash.message
    }
});
</script>

<template>
    <Head title="Welcome" />
    <vueAlert v-if="showMessage" :message="showMessage" :show="true" :alertBg="'bg-red-400 text-white'"></vueAlert>
    <div class="relative min-h-screen bg-[var(--custom-bg)] flex items-center justify-center">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-300 hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-600 px-2 py-1"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-300 hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-600 px-2 py-1"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-300 hover:text-gray-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-gray-600 px-2 py-1"
                    >Register</Link
                >
            </template>
        </div>
        <div class=" text-center">
            <h1 class="text-lg text-gray-300 m-0">Welcome to demo Task</h1>
            <p class="text-sm text-gray-300 m-0">Made by azeem U Rehman</p>

            </div>
    </div>
</template>

<style></style>
