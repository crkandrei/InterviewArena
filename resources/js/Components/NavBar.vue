<template>
    <div class="bg-white shadow-md relative z-10">
        <nav class="container px-8 py-6 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-between">
                <a href="/" class="flex items-center text-2xl font-semibold md:text-2xl hover:text-grey">
                    <!-- Adding the icon here -->
                    <img :src="assets.logo" alt="Icon" class="mr-2 h-10 align-middle" />
                    InterviewArenaAI
                </a>

                <!-- Mobile menu button -->
                <div @click="toggleNav" class="flex md:hidden">
                    <button type="button" class="text-gray-100 hover:text-gray-400 focus:outline-none focus:text-gray-400">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <ul :class="showMenu ? 'flex' : 'hidden'" class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
                <li class="bg-blue-500 text-white px-4 py-2 rounded">Start now</li>
                <li class="text-gray-600 hover:text-black">Pricing</li>
                <li class="text-gray-600 hover:text-black">About Us</li>
                <li v-if="!assets.isAuthenticated" class="text-gray-600 hover:text-black">
                    <a
                        href="/login"
                        class="items-center text-gray-600 hover:text-black"
                    >
                        Log in
                    </a>
                </li>
                <li v-if="assets.isAuthenticated" class="relative">
                    <!-- Dropdown Trigger Button -->
                    <button
                        @click="toggleDropdown"
                        ref="dropdownTrigger"
                        type="button"
                        class="inline-flex items-center text-gray-600 hover:text-black"
                    >
                        {{ $page.props.auth.user.name }}
                        <svg
                            class="ml-2 -mr-0.5 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <ul ref="dropdownMenu"  v-show="showDropdown"  class="absolute z-50 mt-2 rounded-md shadow-lg w-48 bg-white py-1">
                        <li class="px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                            <a href="route('admin.dashboard')" v-if="$page.props.auth.user && $page.props.auth.user.is_admin">Admin Dashboard</a>
                        </li>
                        <li class="px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                            <a href="route('profile.edit')">Profile</a>
                        </li>
                        <li class="px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                            <a href="route('profile.questioners.list')">My Questioners</a>
                        </li>
                        <li class="px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                            <form action="/logout" method="post" class="inline">
                                <!-- If you're using Laravel or a framework that requires a CSRF token, include it here -->
                                <input type="hidden" name="_token" :value="csrfToken">
                                <button type="submit" class="bg-transparent border-none p-0 text-left hover:underline">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount  } from 'vue';
import DropdownLink from '@/components/DropdownLink.vue';
import Dropdown from '@/components/Dropdown.vue';

const showMenu = ref(false);
const toggleNav = () => (showMenu.value = !showMenu.value);
const showDropdown = ref(false);
const toggleDropdown = () => (showDropdown.value = !showDropdown.value);
// Refs for dropdown and trigger button
const dropdownMenu = ref(null);
const dropdownTrigger = ref(null);
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Check if click is outside dropdown and trigger button
const handleClickOutside = (event) => {
    if (
        dropdownMenu.value &&
        !dropdownMenu.value.contains(event.target) &&
        !dropdownTrigger.value.contains(event.target)
    ) {
        showDropdown.value = false;
    }
}

// Add and remove global click event listener
onMounted(() => {
    document.addEventListener('click', handleClickOutside);
});

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside);
});

const assets = window.assets;
</script>
