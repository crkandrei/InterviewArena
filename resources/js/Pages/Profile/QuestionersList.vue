<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h1 class="text-2xl mb-4">Your Questioners</h1>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Prompt</th>
                            <th class="py-2 px-4 border-b">Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="questioner in questioners.data" :key="questioner.id">
                            <td class="py-2 px-4 border-b">{{ questioner.prompt }}</td>
                            <td class="py-2 px-4 border-b">{{ formatDate(questioner.created_at) }}</td>
                            <td class="py-2 px-4 border-b">
                                <button @click="goToQuestioner(questioner.id)" class="px-4 py-2 bg-blue-500 text-white rounded">
                                    View
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <nav class="mt-4 flex justify-end">
                        <button @click="goToPage(questioners.prev_page_url)" :disabled="!questioners.prev_page_url" class="px-4 py-2 mr-2 bg-gray-300 text-white rounded disabled:opacity-50">
                            Previous
                        </button>
                        <button @click="goToPage(questioners.next_page_url)" :disabled="!questioners.next_page_url" class="px-4 py-2 bg-blue-500 text-white rounded disabled:opacity-50">
                            Next
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import Loader from '@/Components/Loader.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref, watchEffect  } from 'vue';

const props = defineProps({
    questioners: {
        type: Object,
        required: true,
    },
});

watchEffect(() => {
    console.log('Questioners:', props.questioners.data);
});
// Method to navigate to a different page of the paginated data
const goToPage = (url) => {
    if (url) {
        Inertia.visit(url);
    }
};
const formatDate = (dateString) => {
    const date = new Date(dateString);
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0'); // January is 0!
    const year = date.getFullYear();

    return `${day}/${month}/${year}`;
};

const goToQuestioner = (id) => {
    Inertia.visit(`/questioner/${id}`);
};


</script>
