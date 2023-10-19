<template>
    <AuthenticatedLayout>
            <div class="py-12 px-6">
                <div class="max-w-7xl mx-auto sm:px-6 rounded-2xl lg:px-8">
                    <div class="max-w-lg mx-auto mt-10 bg-white rounded-2xl shadow-custom">
                        <!-- Header Tabs -->
                        <div class="flex mb-4 relative bg-blue-100 rounded-t-xl h-14 from-blue-200 to-white">
                            <h2 @click="formVersion = 'A'" :class="formVersion === 'A' ? tabActiveClass : tabInactiveClass">Profile Description</h2>
                            <h2 @click="formVersion = 'B'" :class="formVersion === 'B' ? tabActiveClass : tabInactiveClass">Job Description</h2>
                            <div v-if="formVersion === 'A'" class="absolute left-1/4 transform -translate-x-1/2 bottom-0 w-1/4 h-0.5 bg-blue-400 rounded-lg"></div>
                            <div v-if="formVersion === 'B'" class="absolute right-1/4 transform translate-x-1/2 bottom-0 w-1/4 h-0.5 bg-blue-400 rounded-lg"></div>
                        </div>

                            <!-- Form A -->
                            <div v-if="formVersion === 'A'">
                                <form @submit.prevent="handleProfileFormSubmit" class="space-y-4 p-6 bg-white shadow-md rounded-2xl">
                                    <p class="text-gray-600 flex">
                                        <img :src="assets.infoImage" class="mt-3 w-4 sm:w-4 h-4 sm:h-4 mr-4">
                                        Fill the form according to your work experience and we will generate questions accordingly with those.
                                    </p>
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-600">Job</label>
                                    <vue3-select id="domainField" :options="formattedOccupations" v-model="selectedOccupation" class="w-full rounded-md select-height"></vue3-select>
                                </div>

                                <!-- Technology Section -->
                                <div class="mt-2">
                                    <label for="technology" class="block text-sm font-semibold text-gray-600 mt-7">Skills</label>
                                    <input id="technology" v-model="currentTag" @keydown.enter.prevent="addTag" placeholder="Use ENTER to add a skill to the list." class="w-full p-2 rounded-md border-gray-400" />
                                    <div class="flex flex-wrap mb-2">
                                        <span v-for="(tag, index) in profileForm.technology" :key="index" class="bg-blue-welcome text-white py-1 px-3 rounded-md mr-2 mt-2 mb-2 flex items-center">
                                            {{ tag }}
                                            <button type="button" @click="removeTag(index)" class="ml-2 text-white text-xl">
                                                <i class="icon">
                                                  <img :src="assets.xSvgIconUrl" alt="Icon Description" class="w-4 h-4">
                                                </i>
                                            </button>
                                        </span>
                                    </div>
                                    <!-- Hidden input field to satisfy the "required" condition -->
                                    <input type="hidden" name="technology" :value="profileForm.technology.join(',')" required />
                                </div>

                                <!-- Years of Experience Section -->
                                <div>
                                    <label for="experienceLevel" class="block text-sm font-semibold text-gray-600 mt-7">Years of experience</label>
                                    <input id="experienceLevel" v-model="profileForm.experienceLevel" placeholder="4" required class="w-full p-2 rounded-md  mb-3 border-gray-400" />
                                </div>

                                <!-- Submit Button -->
                                <button v-if="!loading" type="submit" class="w-full bg-blue-welcome text-white font-black p-3 rounded-md hover:bg-blue-300 transition ease-in-out duration-150">Submit</button>
                                <Loader v-else />
                            </form>

                            </div>

                            <!-- Form B -->
                            <div v-if="formVersion === 'B'">
                                <form @submit.prevent="handleJobDescriptionFormSubmit"  class="space-y-4 p-6 bg-white shadow-md rounded-2xl">
                                    <p class="text-gray-600 flex">
                                        <img :src="assets.infoImage" class="mt-3 w-4 sm:w-4 h-4 sm:h-4 mr-4">
                                        Paste the description of the job you will get interviewed for and we will generate questions accordingly with those.
                                    </p>
                                    <div>
                                        <label for="jobDescription" class="block text-sm font-semibold">Job Description:</label>
                                        <textarea id="jobDescription" v-model="jobDescriptionForm.description" placeholder="Seeking a full-stack developer with expertise in React and Node.js to build and maintain our company's web applications. Knowledge of AWS and Docker is a plus." rows="18" required class="w-full p-2 border rounded-md"></textarea>
                                    </div>

                                    <button v-if="!loading" type="submit" class="w-full bg-blue-welcome text-white font-black p-3 rounded-md hover:bg-blue-300 transition ease-in-out duration-150">Submit</button>
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
const formVersion = ref('A');

const tabActiveClass = computed(() => 'flex-1 text-center py-4 px-4 bg-white font-black rounded-t-xl shadow-t-md cursor-pointer');
const tabInactiveClass = computed(() => 'flex-1 text-center py-4 px-4 bg-transparent rounded-t-xl cursor-pointer hover:bg-blue-200');

const props = defineProps({
    occupations: {
        type: Array,
        default: () => []
    },
    xSvgIconUrl : String
});

const assets = window.assets;

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

const currentTag = ref('');

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
<style>

h2 {
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}
.vs__dropdown-toggle {
    border-color: rgb(156 163 175 / 1);
    height: 2.75em;
    border-radius: 0.375rem;
}

</style>
