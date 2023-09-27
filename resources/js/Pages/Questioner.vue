<template>
    <Head title="Form" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800 leading-tight text-center mb-6">Form</h2>
        </template>
        <div class="flex justify-center">
            <div class="w-full max-w-2xl p-5 bg-white rounded shadow-lg">
                <div v-for="(question, index) in questions" :key="index" class="mb-4">
                    <p class="text-lg font-medium text-gray-700 mb-2">{{ question }}</p>
                    <input type="text" v-model="answers[index]" placeholder="Your answer" class="w-full p-2 border border-gray-300 rounded" />
                    <p v-if="feedbacks[index+1]" class="text-sm text-red-500">{{ feedbacks[index+1] }}</p>
                </div>
                <button @click="handleSubmit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition-all">Submit Answers</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const questions = ref(JSON.parse(localStorage.getItem('questions')) || []);
const answers = ref(questions.value.map(() => ''));
const feedbacks = ref([]);

const handleSubmit = async () => {
    try {
        // Prepare the payload with questions and answers
        const payload = {
            questions: questions.value,
            answers: answers.value
        };
        // Send a POST request to the server endpoint
        const response = await axios.post('/submit-answers', payload);
        // Split the response by newline characters and parse each line as JSON
        const feedbackStrings = response.data.feedback.split('\n\n');
        feedbackStrings.forEach(feedbackStr => {
            const feedback = JSON.parse(feedbackStr);
            Object.assign(feedbacks.value, feedback);
        });
    } catch (error) {
        // Handle the error, show an error message
    }
};
</script>

