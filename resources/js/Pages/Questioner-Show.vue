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
                    <input type="text" v-model="answers[index]" placeholder="Your answer" class="w-full p-2 border border-gray-300 rounded" readonly />
                    <p v-if="feedbacks[index]" class="text-sm text-red-500">Feedback: {{ feedbacks[index] }}</p>
                    <p v-if="scores[index]" class="text-sm text-green-500">Score: {{ scores[index] }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>

import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps, watchEffect } from 'vue';


const props = defineProps({
    questions: {
        type: Object,
        required: true,
    },
    answers: {
        type: Object,
        required: true
    },
    feedbacks: {
        type: Object,
        required: true
    },
    scores: {
        type: Object,
        required: true
    }
});


watchEffect(() => {
    console.log(props.questions, props.answers, props.feedbacks, props.scores);  //Log the props to see if they are being received correctly
});
</script>

