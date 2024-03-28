<script setup>
import { useForm, Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
const form = useForm({
    title: "",
    description: "",
    category: "",
    userName: "",
});
const submit = () => {
    form.post(route("feedback.store"), {
        onFinish: () => form.reset(),
    });
};
</script>
<template>
    <GuestLayout>
        <Head title="Feedback" />
        <form @submit.prevent="submit">
            <div>
                <InputLabel for="title" value="title" />

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Add title"
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>
            <div>
                <InputLabel for="description" value="description" />
                <textarea
                    id="description"
                    v-model="form.description"
                    placeholder="Add feedback"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white text-gray-900 focus:border-grayy-900  focus:ring-gray-900 rounded-md shadow-sm"
                    required
                ></textarea>

                <InputError class="mt-2" :message="form.errors.description" />
            </div>
            <div>
                <InputLabel for="category" value="category" />
                <select
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 bg-white text-gray-900 focus:border-grayy-900  focus:ring-gray-900 rounded-md shadow-sm"
                    v-model="form.category"
                    id="category"
                    autocomplete="category-name"
                >
                    <option value="">select category</option>
                    <option value="bug report">bug report</option>
                    <option value="feature request">feature request</option>
                    <option value="improvement">improvement</option>
                    <option value="favourite">favourite</option>
                </select>

                <InputError class="mt-2" :message="form.errors.category" />
            </div>
            <div>
                <InputLabel for="userName" value="Name" />

                <TextInput
                    id="userName"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.userName"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Add your Name"
                />

                <InputError class="mt-2" :message="form.errors.userName" />
            </div>
            <div class="flex items-center justify-between mt-4">
                <Link
                    :href="route('dashboard')"
                    class="underline text-sm text-white rounded-md focus:outline-none"
                >
                    Back to Dashboard?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Submit
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
