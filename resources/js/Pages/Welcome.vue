<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <header class="bg-blue-button text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">InterviewArenaAI</h1>
            <div class="space-x-4">
                <a href="/pricing" class="hover:text-gray-300">Pricing</a>
                <a href="/login" class="hover:text-gray-300">Login/Register</a>
            </div>
        </div>
    </header>
    <section class="bg-color-1 text-center py-80">
        <!-- Using the specified font for the heading -->
        <h1 class="text-6xl font-bold mb-4" style="font-family: 'Dela Gothic One', cursive;">
            <span class="hidden md:inline">Welcome to Interview</span><span class="md:hidden">Welcome to Interview<br></span>ArenaAI
        </h1>
        <!-- Two buttons with specified colors and text -->
        <div class="flex justify-center">
            <div class="flex flex-col space-y-4 md:space-y-0 md:space-x-4 md:flex-row">
                <a href="/profile-questions" class="bg-blue-500 text-white px-6 py-3 rounded-lg inline-block w-full md:w-auto text-center shadow-lg transform transition hover:bg-blue-600 hover:shadow-xl hover:-translate-y-1 hover:scale-105">
                    Profile Questions
                </a>
                <a href="/job-description-questions" class="bg-yellow-500 text-black px-6 py-3 rounded-lg inline-block w-full md:w-auto text-center shadow-lg transform transition hover:bg-yellow-600 hover:shadow-xl hover:-translate-y-1 hover:scale-105">
                    Job Description Questions
                </a>
            </div>
        </div>
    </section>
    <section class="py-20 bg-blue-button">
        <h2 class="text-3xl font-bold text-center mb-10">Why Choose InterviewArena for Your Interview Preparation?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Card 1 -->
            <div class="text-center p-6 bg-yellow-button border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <i class="fas fa-user-cog text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-4">Personalized Interview Questions</h3>
                <p>At InterviewArena, we provide personalized questions based on your unique profile or job description, helping you prepare effectively and stand out in interviews.</p>
            </div>
            <!-- Card 2 -->
            <div class="text-center p-6 bg-yellow-button border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <i class="fas fa-clock text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-4">Quick, AI-Driven Feedback</h3>
                <p>Receive instant, AI-driven feedback on your answers, allowing you to identify and improve on your weaknesses, enhancing your interview skills.</p>
            </div>
            <!-- Card 3 -->
            <div class="text-center p-6 bg-yellow-button border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <i class="fas fa-shield-alt text-4xl mb-4"></i>
                <h3 class="text-xl font-semibold mb-4">Secure and Private Preparation Platform</h3>
                <p>Your data and preparation materials are kept secure and private, ensuring your peace of mind as you prepare for your interviews with InterviewArena.</p>
            </div>
        </div>
    </section>

    <section class="bg-yellow-button py-20">
        <h2 class="text-3xl font-bold text-center mb-10">How Does InterviewArena Work?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Step 1 -->
            <div class="text-center p-6 bg-white border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <i class="fas fa-pencil-alt text-4xl mb-4"></i>
                <p>Start by filling in your profile or pasting a job description. This information allows us to generate personalized interview questions tailored to your specific needs and goals.</p>
            </div>
            <!-- Step 2 -->
            <div class="text-center p-6 bg-white border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <i class="fas fa-robot text-4xl mb-4"></i>
                <p>Our advanced AI analyzes the data to generate relevant and challenging questions that help you prepare for real-world interviews, ensuring you are ready for any question.</p>
            </div>
            <!-- Step 3 -->
            <div class="text-center p-6 bg-white border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <i class="fas fa-comment-dots text-4xl mb-4"></i>
                <p>Practice answering the questions and receive instant feedback from our AI. This feedback helps you understand your strengths and weaknesses, allowing you to improve your answers and increase your chances of interview success.</p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-blue-button text-white">
        <h2 class="text-3xl font-bold text-center mb-10">What Our Users Say</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Testimonial 1 -->
            <div class="text-center p-6 bg-white text-black border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <img src="path_to_user1_photo.png" alt="User 1" class="mb-4 rounded-full w-24 h-24 mx-auto">
                <h3 class="text-xl font-semibold mb-2">John Doe</h3>
                <p class="italic">"This platform revolutionized my interview preparation!"</p>
            </div>
            <!-- Testimonial 2 -->
            <div class="text-center p-6 bg-white text-black border border-gray-300 rounded-lg shadow-md hover:shadow-lg transition">
                <img src="path_to_user2_photo.png" alt="User 2" class="mb-4 rounded-full w-24 h-24 mx-auto">
                <h3 class="text-xl font-semibold mb-2">Jane Smith</h3>
                <p class="italic">"The AI-driven feedback is incredibly accurate."</p>
            </div>
        </div>
    </section>

    <footer class="bg-blue-900 text-white py-10">
        <div class="container mx-auto text-center">
            <p class="mb-6">© 2023 InterviewArena. All rights reserved.</p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="hover:text-gray-300">About</a>
                <a href="#" class="hover:text-gray-300">Contact</a>
                <a href="#" class="hover:text-gray-300">FAQ</a>
                <a href="#" class="hover:text-gray-300">Terms of Service</a>
                <a href="#" class="hover:text-gray-300">Privacy Policy</a>
            </div>
        </div>
    </footer>


</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
