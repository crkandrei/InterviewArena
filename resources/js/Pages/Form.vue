<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Form</h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Profile Form -->
                    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                        <!-- Profile Form -->
                        <div v-if="props.type === 'profile'">
                            <form @submit.prevent="handleProfileFormSubmit" class="space-y-4">
                                <div>
                                    <label for="domainField" class="block text-sm font-semibold">Domain or Field:</label>
                                    <input id="domainField" v-model="profileForm.domainField" placeholder="e.g., Web Development" required class="w-full p-2 border rounded-md" />
                                </div>

                                <div>
                                    <label for="technology" class="block text-sm font-semibold">Technology or Language:</label>
                                    <input id="technology" v-model="profileForm.technology" placeholder="e.g., PHP, Javascript"  required class="w-full p-2 border rounded-md" />
                                </div>

                                <div>
                                    <label for="experienceLevel" class="block text-sm font-semibold">Experience Level:</label>
                                    <input id="experienceLevel" v-model="profileForm.experienceLevel" placeholder="e.g., 3" required class="w-full p-2 border rounded-md" />
                                </div>

                                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Submit</button>
                            </form>
                        </div>

                        <!-- Job Description Form -->
                        <div v-else-if="props.type === 'job-description'">
                            <form @submit.prevent="handleJobDescriptionFormSubmit" class="space-y-4">
                                <div>
                                    <label for="jobDescription" class="block text-sm font-semibold">Job Description:</label>
                                    <textarea id="jobDescription" v-model="jobDescriptionForm.description" placeholder="Paste the descrpition of the job you will get interviwed" required class="w-full p-2 border rounded-md"></textarea>
                                </div>

                                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';

// Define the 'type' prop
const props = defineProps({
    type: String
});

// Form data
const profileForm = ref({
    domainField: '',
    technology: '',
    experienceLevel: ''
});

const jobDescriptionForm = ref({
    description: ''
});

const handleProfileFormSubmit = () => {
    axios.post('/form-submit', {
        type: 'profile',
        data: profileForm.value
    });
};

const handleJobDescriptionFormSubmit = () => {
    axios.post('/form-submit', {
        type: 'job-description',
        data: jobDescriptionForm.value
    });
};

</script>
