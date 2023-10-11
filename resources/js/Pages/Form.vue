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
                                    <label class="block text-sm font-semibold">Job :</label>
                                    <vue3-select id="domainField" :options="formattedOccupations" v-model="selectedOccupation" placeholder=" " class="w-full"></vue3-select>
                                </div>

                                <div class="mb-4">
                                    <label for="technology" class="block text-sm font-semibold mb-2">Technology or Language:</label>
                                    <div class="border border-gray-300 p-2 rounded-md">
                                        <div class="flex flex-wrap mb-2">
                                            <span
                                                v-for="(tag, index) in profileForm.technology"
                                                :key="index"
                                                class="bg-blue-500 text-white py-1 px-2 rounded mr-2 mb-2"
                                            >
                                                {{ tag }}
                                                <button type="button" @click="removeTag(index)" class="ml-2 text-red-500">x</button>
                                            </span>
                                        </div>
                                        <input
                                            id="technology"
                                            v-model="currentTag"
                                            @keydown.enter.prevent="addTag"
                                            placeholder="e.g., PHP, Javascript"
                                            class="w-full p-2 border rounded-md border-transparent"
                                        />
                                        <!-- Hidden input field to satisfy the "required" condition -->
                                        <input type="hidden" name="technology" :value="profileForm.technology.join(',')" required />
                                        <small class="block text-gray-500 mt-2">Type a technology and press Enter to add it. No commas needed.</small>
                                    </div>
                                </div>

                                <div>
                                    <label for="experienceLevel" class="block text-sm font-semibold">Years of Experience:</label>
                                    <input id="experienceLevel" v-model="profileForm.experienceLevel" placeholder="e.g., 3" required class="w-full p-2 border rounded-md" />
                                </div>

                                <button v-if="!loading" type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Submit</button>
                                <Loader v-else />
                            </form>
                        </div>

                        <!-- Job Description Form -->
                        <div v-else-if="props.type === 'job-description'">
                            <form @submit.prevent="handleJobDescriptionFormSubmit" class="space-y-4">
                                <div>
                                    <label for="jobDescription" class="block text-sm font-semibold">Job Description:</label>
                                    <textarea id="jobDescription" v-model="jobDescriptionForm.description" placeholder="Paste the descrpition of the job you will get interviwed" required class="w-full p-2 border rounded-md"></textarea>
                                </div>

                                <button v-if="!loading" type="submit" class="w-full bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600">Submit</button>
                                <Loader v-else />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Loader from '@/Components/Loader.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';
import 'vue3-select/dist/vue3-select.css';
import vue3Select from 'vue3-select';



const props = defineProps({
    occupations: {
        type: Array,
        default: () => []
    },
    type: String
});


const jobDescriptionForm = ref({
    description: ''
});

const loading = ref(false);

const selectedOccupation = computed({
    get: () => profileForm.value.domainField,
    set: (newValue) => {
        profileForm.value.domainField = newValue.value;
    }
});

// New ref for capturing the current tag input
const currentTag = ref('');

// Updated profileForm to hold an array of tags for technology
const profileForm = ref({
    domainField: '',
    technology: [],
    experienceLevel: ''
});

const addTag = () => {
    if (currentTag.value && !profileForm.value.technology.includes(currentTag.value)) {
        profileForm.value.technology.push(currentTag.value);
        currentTag.value = '';
    }
};

const removeTag = (index) => {
    profileForm.value.technology.splice(index, 1);
};

const handleProfileFormSubmit = async () => {
    loading.value = true;
    try {
        const response = await axios.post('/form-submit', {
            type: 'profile',
            data: profileForm.value
        });
        localStorage.setItem('questions', JSON.stringify(response.data.questions));
        window.location.href = '/questioner';
    } catch (err) {
        error.value = err.response.data.message;
    } finally {
        loading.value = false;
    }
};

const formattedOccupations = computed(() => {
    return props.occupations.map(occupation => ({ value: occupation.occupation, label: occupation.occupation }));
});

const handleJobDescriptionFormSubmit = async () => {

    loading.value = true;
    try {
        const response = await axios.post('/form-submit', {
            type: 'job-description',
            data: jobDescriptionForm.value
        });
        localStorage.setItem('questions', JSON.stringify(response.data.questions));
        window.location.href = '/questioner';
    } catch (err) {
        error.value = err.response.data.message;
    } finally {
        loading.value = false;
    }
};

</script>
