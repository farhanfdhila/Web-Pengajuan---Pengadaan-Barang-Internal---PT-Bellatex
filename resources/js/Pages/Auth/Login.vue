<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-gray-900 via-[#111827] to-slate-900">
        <!-- Animated Background Gradient -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/20 mix-blend-screen blur-[120px] animate-blob"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-indigo-600/20 mix-blend-screen blur-[150px] animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 w-full max-w-md px-6 py-12 mx-auto">
            <!-- Glassmorphism Card -->
            <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                
                <!-- Logo & Title -->
                <div class="text-center mb-8">
                    <img src="/images/logo.png" alt="PT Bellatex" class="h-16 w-auto mx-auto mb-4" onerror="this.outerHTML='<div class=\'inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 mb-4 shadow-lg text-white font-bold text-xl\'>BX</div>'" />
                    <h2 class="text-2xl font-extrabold text-white tracking-tight">Login</h2>
                    <p class="text-gray-400 mt-1 text-sm font-medium">Masuk ke Portal Pengadaan</p>
                </div>

                <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center bg-green-50 py-2 rounded-lg border border-green-200">
                    {{ status }}
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <input
                                id="email"
                                type="email"
                                class="block w-full pl-10 bg-gray-900/50 border border-white/10 focus:border-blue-400 focus:ring-blue-400/30 rounded-xl text-white py-3 transition-all duration-300 shadow-sm hover:bg-gray-800/80"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                                placeholder="nama@bellatex.com"
                            />
                        </div>
                        <p v-if="form.errors.email" class="mt-2 text-sm text-red-500">{{ form.errors.email }}</p>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input
                                id="password"
                                type="password"
                                class="block w-full pl-10 bg-white/70 border border-gray-200 focus:border-blue-500 focus:ring-blue-500/30 rounded-xl text-gray-900 py-3 transition-all duration-300 shadow-sm hover:bg-white"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                            />
                        </div>
                        <p v-if="form.errors.password" class="mt-2 text-sm text-red-500">{{ form.errors.password }}</p>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" v-model="form.remember" class="w-4 h-4 rounded border-gray-700 bg-gray-900 text-blue-500 focus:ring-blue-500/50 transition" />
                            <span class="ml-2 text-sm font-medium text-gray-400 group-hover:text-gray-200 transition">Ingat Saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full relative flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/30 transform transition hover:-translate-y-0.5"
                            :class="{ 'opacity-70 cursor-not-allowed': form.processing }"
                            :disabled="form.processing"
                        >
                            <span v-if="!form.processing">Masuk Sekarang</span>
                            <span v-else class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>

                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-400">
                            Belum punya akun? 
                            <Link v-if="canResetPassword" :href="route('password.request')" class="font-bold text-blue-400 hover:text-blue-300 transition">daftar disini</Link>
                        </p>
                    </div>
                </form>
                
                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <p class="text-xs text-gray-400">
                        &copy; {{ new Date().getFullYear() }} PT Bellatex Jaya Maju Bersama.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
