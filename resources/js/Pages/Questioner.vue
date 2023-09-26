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
                </div>
                <button @click="handleSubmit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition-all">Submit Answers</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';

const questions = ref(JSON.parse(localStorage.getItem('questions')) || []);
const answers = ref(questions.value.map(() => ''));

const handleSubmit = async () => {
    try {
        const response = await this.$axios.post('/submit-answers', { answers: answers.value });
        // Handle the response, navigate to another page or show a message
    } catch (error) {
        // Handle the error, show an error message
    }
};
</script>

