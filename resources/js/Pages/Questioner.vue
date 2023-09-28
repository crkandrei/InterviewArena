<template>
    <Head title="Form" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight text-center mb-6">Form</h2>
        </template>
        <div class="flex justify-center">
            <div class="w-full max-w-2xl p-5 bg-white rounded shadow-lg">
                <div v-for="(question, index) in questions" :key="index" class="mb-4">
                    <p class="text-lg font-medium text-gray-700 mb-2">{{ question.content }}</p>
                    <input type="text" v-model="answers[index]" placeholder="Your answer" class="w-full p-2 border border-gray-300 rounded" />
                    <p v-if="feedbacks[index+1]" class="text-sm text-red-500">Feedback: {{ feedbacks[index+1] }}</p>
                    <p v-if="scores[index+1]" class="text-sm text-green-500">Score: {{ scores[index+1] }}</p>
                </div>

                <button v-if="!loading" @click="handleSubmit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition-all">Submit Answers</button>
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
</script>

