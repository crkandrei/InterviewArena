<template>
    <Head title="Form" />
    <AuthenticatedLayout>
        <div class="py-8 lg:px-6 relative z-10">
            <div class="mx-auto w-11/12 lg:w-4/6 lg:px-8 rounded-2xl">
                <div v-for="(question, index) in questions" :key="index" class="mb-4 rounded-2xl shadow-custom">
                    <div class="border flex bg-blue-welcome w-full rounded-t-2xl">
                        <p class="text-yellow ml-6 mt-4 text-5xl font-black">{{ index+1 }}</p>
                        <p class="text-lg font-medium text-white mt-3 px-4 mb-2">{{ question.content.slice(2) }}</p>
                    </div>
                    <div class="p-4 bg-white rounded-b-2xl ">
                        <textarea v-model="answers[index]" rows="5" placeholder="Your answer" class="w-full p-2 rounded-b-2xl border border-gray-300 rounded" />
                        <div v-if="feedbacks[index+1]" class="bg-blue-washed bg-blue-washed border rounded-2xl p-3">
                            <div class="flex">
                                <p v-if="feedbacks[index+1]" class="text-sm font-black">Feedback:</p>
                                <p
                                    v-if="scores[index+1]"
                                    class="text-sm w-11 text-center border rounded-md text-white"
                                    :class="getBackgroundColor(scores[index+1])"
                                >
                                    {{ scores[index+1] }}/10
                                </p>
                            </div>
                            <p v-if="feedbacks[index+1]" class="text-sm">{{ feedbacks[index+1] }}</p>
                        </div>
                    </div>
                </div>

                <button v-if="!loading" @click="handleSubmit" class="w-full bg-blue-welcome shadow-custom text-white font-black p-3 rounded-md hover:bg-blue-300 transition ease-in-out duration-150">Submit Answers</button>
                <Loader v-else />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import { ref } from 'vue';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
import { Head } from '@inertiajs/vue3';
import Loader from '@/Components/Loader.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const feedbacks = ref([]);
const scores = ref([]);
const loading = ref(false);
const questions = ref(JSON.parse(localStorage.getItem('questions')) || []);
const answers = ref(questions.value.map(() => ''));
const handleSubmit = async () => {
    loading.value = true;
    try {
        const payload = {
            questions: questions.value,
            answers: answers.value
        };
        console.log(questions.value);
        const response = await axios.post('/submit-answers', payload);

        feedbacks.value = response.data.feedbacks;
        scores.value = response.data.scores;

    } catch (error) {
        const errorMsg = error.response.data.error || 'An error occurred while submitting your answers.';
        toastr.error(errorMsg);
    } finally {
        loading.value = false;
    }
};
function getBackgroundColor(score) {
    if (score >= 0 && score < 4) {
        return 'bg-red-500';
    } else if (score >= 4 && score < 8) {
        return 'bg-yellow-500';
    } else if (score >= 8 && score <= 10) {
        return 'bg-green-500';
    }
    return '';  // default background color (or you can specify another color)
}
</script>

