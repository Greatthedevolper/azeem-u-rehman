<script setup>
import { ref, onMounted, defineProps, defineExpose } from "vue";
import { Inertia } from "@inertiajs/inertia";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from '@inertiajs/inertia-vue3'

const props = defineProps({
    feedbacks: Object,
    flash:Object
});
const { message, error, page } = usePage().props
const showMessage = ref(message)
const showError = ref(error)
const feedbacks = ref(props.feedbacks);
const comment = ref('');
const formId = ref('');
const alertMessage = ref(message);
onMounted(() => {
    console.log(feedbacks.value.links, "hello");
    console.log(props.flash.message);
    if (props.flash.message) {
        showMessage.value=props.flash.message
    }
});

const changePage = (url) => {
    Inertia.get(url);
};
const liked = (id) => {
    console.log(id);
    Inertia.post(`/like/${id}`);
};
defineExpose({ changePage });
const isFormVisible = ref(false);
const toggleFormVisibility = (id) => {
    console.log(id);
    formId.value = id;
    isFormVisible.value = !isFormVisible.value;
};

const submitComment = (id) => {
    event.preventDefault();
    console.log(id);
    Inertia.post(`/comment/${id}`, { comment: comment.value });
    formId.value=''
    isFormVisible.value=false
};
</script>

<template>
    <Head title="Dashboard" />
    <vueAlert  :message="showMessage" :show="true"  :alertBg="'bg-green-400 text-white'"></vueAlert>
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-[var(--custom-bg)] overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <div
                        class="flex flex-wrap items-center justify-between p-6"
                    >
                        <div class="text-gray-900 dark:text-gray-100">
                            Hi You are success to get here
                        </div>
                        <Link
                            :href="route('feedback')"
                            class="border border-white text-sm text-white rounded p-2 hover:text-gray-900 hover:border-gray-900 transition-all"
                        >
                            Add your valuable feedback here
                        </Link>
                    </div>

                    <div class="px-4 py-3 bg-[var(--custom-bg)]">
                        <div v-if="feedbacks">
                            <h1 class="text-white">All Feedbacks</h1>
                            <ul
                                class="grid md:grid-cols-2 grid-cols-1 gap-2 my-2"
                            >
                                <li
                                    v-for="feedback in feedbacks.data"
                                    :key="feedback.id"
                                >
                                    <div class="border bg-white p-4 rounded">
                                        <div
                                            class="flex items-center justify-between mb-1"
                                        >
                                            <h2
                                                class="text-gray-700 text-lg font-medium capitalize"
                                            >
                                                {{ feedback.title }}
                                            </h2>
                                            <div
                                                class="flex items-center gap-1"
                                            >
                                                <span class="text-[10px]"
                                                    >Category</span
                                                >
                                                <span
                                                    class="rounded-full px-2 text-[12px] bg-blue-500 text-gray-100"
                                                    >{{
                                                        feedback.category
                                                    }}</span
                                                >
                                            </div>
                                        </div>
                                        <p
                                            class="text-gray-700 text-sm text-wrap truncate-3-lines max-h-[60px] min-h-[60px]"
                                        >
                                            {{ feedback.description }}
                                        </p>
                                        <div
                                            class="flex items-center justify-between"
                                        >
                                            <div
                                                class="flex gap-3 items-center"
                                            >
                                                <div
                                                    class="flex items-center gap-1"
                                                >
                                                    <span
                                                        role="button"
                                                        @click="
                                                            toggleFormVisibility(
                                                                feedback.id
                                                            )
                                                        "
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512"
                                                            width="18"
                                                            height="18"
                                                        >
                                                            <path
                                                                d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z"
                                                            />
                                                        </svg>
                                                    </span>
                                                    <span
                                                        class="text-[10px]"
                                                        v-if="
                                                            feedback.comments.length >=
                                                            1
                                                        "
                                                        >{{ feedback.comments.length }}</span
                                                    >
                                                </div>
                                                <div
                                                    class="flex items-center gap-1"
                                                >
                                                    <span
                                                        role="button"
                                                        @click="
                                                            liked(feedback.id)
                                                        "
                                                    >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            viewBox="0 0 512 512"
                                                            width="18"
                                                            height="18"
                                                        >
                                                            <path
                                                                d="M323.8 34.8c-38.2-10.9-78.1 11.2-89 49.4l-5.7 20c-3.7 13-10.4 25-19.5 35l-51.3 56.4c-8.9 9.8-8.2 25 1.6 33.9s25 8.2 33.9-1.6l51.3-56.4c14.1-15.5 24.4-34 30.1-54.1l5.7-20c3.6-12.7 16.9-20.1 29.7-16.5s20.1 16.9 16.5 29.7l-5.7 20c-5.7 19.9-14.7 38.7-26.6 55.5c-5.2 7.3-5.8 16.9-1.7 24.9s12.3 13 21.3 13L448 224c8.8 0 16 7.2 16 16c0 6.8-4.3 12.7-10.4 15c-7.4 2.8-13 9-14.9 16.7s.1 15.8 5.3 21.7c2.5 2.8 4 6.5 4 10.6c0 7.8-5.6 14.3-13 15.7c-8.2 1.6-15.1 7.3-18 15.2s-1.6 16.7 3.6 23.3c2.1 2.7 3.4 6.1 3.4 9.9c0 6.7-4.2 12.6-10.2 14.9c-11.5 4.5-17.7 16.9-14.4 28.8c.4 1.3 .6 2.8 .6 4.3c0 8.8-7.2 16-16 16H286.5c-12.6 0-25-3.7-35.5-10.7l-61.7-41.1c-11-7.4-25.9-4.4-33.3 6.7s-4.4 25.9 6.7 33.3l61.7 41.1c18.4 12.3 40 18.8 62.1 18.8H384c34.7 0 62.9-27.6 64-62c14.6-11.7 24-29.7 24-50c0-4.5-.5-8.8-1.3-13c15.4-11.7 25.3-30.2 25.3-51c0-6.5-1-12.8-2.8-18.7C504.8 273.7 512 257.7 512 240c0-35.3-28.6-64-64-64l-92.3 0c4.7-10.4 8.7-21.2 11.8-32.2l5.7-20c10.9-38.2-11.2-78.1-49.4-89zM32 192c-17.7 0-32 14.3-32 32V448c0 17.7 14.3 32 32 32H96c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32H32z"
                                                            />
                                                        </svg>
                                                    </span>
                                                    <span
                                                        class="text-[10px]"
                                                        v-if="
                                                            feedback.likes >= 1
                                                        "
                                                        >{{
                                                            feedback.likes
                                                        }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div
                                                class="flex items-center justify-end gap-1"
                                            >
                                                <span class="text-[10px]"
                                                    >Added by</span
                                                >
                                                <p
                                                    class="text-[16px] text-dark capitalize"
                                                >
                                                    {{ feedback.userName }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div
                                class="pagination flex items-center justify-end gap-1"
                            >
                                <button
                                    class="text-white px-2 border border-white rounded hover:text-[var(--custom-bg)] hover:bg-white"
                                    v-if="feedbacks.first_page_url"
                                    @click="changePage(feedbacks.first_page_url)"
                                >
                                    Previous
                                </button>
                                <button
                                    class="text-white px-2 border border-white rounded hover:text-[var(--custom-bg)] hover:bg-white"
                                    v-if="feedbacks.next_page_url"
                                    @click="changePage(feedbacks.next_page_url)"
                                >
                                    Next
                                </button>
                            </div>
                        </div>
                        <div v-else class="flex items justify-center">
                            <p class="text-white">No Feedback Yet</p>
                        </div>
                    </div>
                </div>
            </div>
            <form
            @submit.prevent="submitComment(formId, $event)" :class="{ hidden: !isFormVisible }" :id="formId"
    class="py-5 px-5 fixed top-1/2 -translate-y-1/2 -translate-x-1/2 start-1/2 bg-[var(--custom-bg)] rounded"
>
    <textarea
        name="comment"
        v-model="comment"
        cols="30"
        rows="10"
        class="p-2 focus:border-red border resize-none w-full rounded"
    ></textarea>

    <div class="text-end">
        <button
            type="submit"
            class="border border-white text-white rounded px-2"
        >
            Submit
        </button>
    </div>
</form>


        </div>
    </AuthenticatedLayout>
</template>
