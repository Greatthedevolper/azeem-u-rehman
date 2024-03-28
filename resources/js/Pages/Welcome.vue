<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />

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
            <h1 class="text-lg text-gray-300 m-0">Welcome to Advance Task</h1>
            <p class="text-sm text-gray-300 m-0">Made by azeem U Rehman</p>
        </div>
    </div>
</template>

<style></style>
