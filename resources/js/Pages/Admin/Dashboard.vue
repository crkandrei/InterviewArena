<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You're Admin!
                        <!-- Add this button -->
                        <button @click="createSubscription" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">Create Subscription</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const createSubscription = async () => {
    try {
        const response = await fetch('/create-subscription', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });
        const result = await response.json();
        if (result.success) {
            alert('Subscription created successfully');
        } else if (result.requires_action_url) {
            // Redirect the user to the action URL for payment authorization
            window.location.href = result.requires_action_url;
        } else {
            alert('Failed to create subscription: ' + result.error);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('An error occurred while creating the subscription');
    }
};
</script>
