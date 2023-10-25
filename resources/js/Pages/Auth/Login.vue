<template>
    <GuestLayout>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div>
            <div class="max-w-7xl mx-auto rounded-3xl">
                <div class="max-w-lg mx-auto bg-white rounded-3xl">
                    <!-- Header Tabs -->
                    <div class="flex mb-4 relative bg-blue-100 rounded-t-2xl h-14 from-blue-200 to-white">
                        <h2 @click="formVersion = 'A'" :class="formVersion === 'A' ? tabActiveClass : tabInactiveClass">Login</h2>
                        <h2 @click="formVersion = 'B'" :class="formVersion === 'B' ? tabActiveClass : tabInactiveClass">Register</h2>
                        <div v-if="formVersion === 'A'" class="absolute left-1/4 transform -translate-x-1/2 bottom-0 w-1/4 h-0.5 bg-blue-400 rounded-lg"></div>
                        <div v-if="formVersion === 'B'" class="absolute right-1/4 transform translate-x-1/2 bottom-0 w-1/4 h-0.5 bg-blue-400 rounded-lg"></div>
                    </div>

                    <!-- Form A -->
                    <div v-if="formVersion === 'A'">
                        <form @submit.prevent="submitLogin" class="p-3  shadow-custom">
                            <div>
                                <InputLabel for="login_email" value="Email" />

                                <TextInput
                                    id="login_email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="formLogin.email"
                                    placeholder="Email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="formLogin.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="loging_password" value="Password" />

                                <TextInput
                                    id="login_password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="formLogin.password"
                                    placeholder="Password"
                                    required
                                    autocomplete="current-password"
                                />

                                <InputError class="mt-2" :message="formLogin.errors.password" />
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox name="remember" v-model:checked="formLogin.remember" />
                                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <PrimaryButton :class="{ 'opacity-25': formLogin.processing }" :disabled="formLogin.processing">
                                    Log in
                                </PrimaryButton>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="w-full underline mb-2 text-center text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Forgot your password?
                                </Link>
                            </div>
                        </form>
                    </div>

                    <!-- Form B -->
                    <div v-if="formVersion === 'B'">

                        <form @submit.prevent="submitRegister" class="p-3">
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="formRegister.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="formRegister.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="register_email" value="Email" />

                                <TextInput
                                    id="register_email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="formRegister.email"
                                    required
                                    autocomplete="username"
                                />

                                <InputError class="mt-2" :message="formRegister.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="register_password" value="Password" />

                                <TextInput
                                    id="register_password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="formRegister.password"
                                    required
                                    autocomplete="new-password"
                                />

                                <InputError class="mt-2" :message="formRegister.errors.password" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password_confirmation" value="Confirm Password" />

                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="formRegister.password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />

                                <InputError class="mt-2" :message="formRegister.errors.password_confirmation" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    :href="route('login')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Already registered?
                                </Link>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton :class="{ 'opacity-25': formRegister.processing }" :disabled="formRegister.processing">
                                    Register
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
<script setup>

import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';


const formVersion = ref('A');
const tabActiveClass = computed(() => 'flex-1 text-center py-4 px-4 bg-white font-black rounded-t-xl shadow-t-md cursor-pointer');
const tabInactiveClass = computed(() => 'flex-1 text-center py-4 px-4 bg-transparent rounded-t-xl cursor-pointer hover:bg-blue-200');

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const formLogin = useForm({
    email: '',
    password: '',
    remember: false,
});

const submitLogin = () => {
    formLogin.post(route('login'), {
        onFinish: () => formLogin.reset('password'),
    });
};


const formRegister = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submitRegister = () => {
    formRegister.post(route('register'), {
        onFinish: () => formRegister.reset('password', 'password_confirmation'),
    });
};

</script>

