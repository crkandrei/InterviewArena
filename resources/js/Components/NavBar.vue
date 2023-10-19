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
                <li class="text-gray-600 hover:text-black">Log in</li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    setup() {
        let showMenu = ref(false);
        const toggleNav = () => (showMenu.value = !showMenu.value);
        const assets = window.assets;
        console.log(assets);
        return { showMenu, toggleNav, assets};
    },
};

</script>
