<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    no_hp: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Pendaftaran Karyawan" />

    <div class="min-h-screen flex items-center justify-center relative overflow-hidden bg-gradient-to-br from-gray-900 via-[#111827] to-slate-900 py-12">
        <!-- Animated Background Gradient -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-[10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/20 mix-blend-screen blur-[120px] animate-blob"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-indigo-600/20 mix-blend-screen blur-[150px] animate-blob animation-delay-2000"></div>
        </div>

        <div class="relative z-10 w-full max-w-md px-6 mx-auto">
            <!-- Glassmorphism Card -->
            <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-[0_8px_30px_rgb(0,0,0,0.12)]">
                
                <!-- Logo & Title -->
                <div class="text-center mb-8">
                    <img src="/images/logo.png" alt="PT Bellatex" class="h-16 w-auto mx-auto mb-4" onerror="this.outerHTML='<div class=\'inline-flex items-center justify-center w-16 h-16 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 mb-4 shadow-lg text-white font-bold text-xl\'>BX</div>'" />
                    <h2 class="text-2xl font-extrabold text-white tracking-tight">Pendaftaran Karyawan</h2>
                    <p class="text-gray-400 mt-1 text-sm font-medium">Buat akun untuk mengajukan barang</p>
                </div>

                <form @submit.prevent="submit" class="space-y-5">
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <input
                                id="name"
                                type="text"
                                class="block w-full pl-10 bg-gray-900/50 border border-white/10 focus:border-blue-400 focus:ring-blue-400/30 rounded-xl text-white py-3 transition-all duration-300 shadow-sm hover:bg-gray-800/80"
                                v-model="form.name"
                                required
                                autofocus
                                autocomplete="name"
                                placeholder="Budi Santoso"
                            />
                        </div>
                        <p v-if="form.errors.name" class="mt-2 text-sm text-red-500">{{ form.errors.name }}</p>
                    </div>

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
                                autocomplete="username"
                                placeholder="nama@bellatex.com"
                            />
                        </div>
                        <p v-if="form.errors.email" class="mt-2 text-sm text-red-500">{{ form.errors.email }}</p>
                    </div>

                    <!-- No HP Input -->
                    <div>
                        <label for="no_hp" class="block text-sm font-medium text-gray-300 mb-1">Nomor WhatsApp / HP</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>
                            </div>
                            <input
                                id="no_hp"
                                type="text"
                                class="block w-full pl-10 bg-gray-900/50 border border-white/10 focus:border-blue-400 focus:ring-blue-400/30 rounded-xl text-white py-3 transition-all duration-300 shadow-sm hover:bg-gray-800/80"
                                v-model="form.no_hp"
                                required
                                placeholder="08..."
                            />
                        </div>
                        <p v-if="form.errors.no_hp" class="mt-2 text-sm text-red-500">{{ form.errors.no_hp }}</p>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            </div>
                            <input
                                id="password"
                                type="password"
                                class="block w-full pl-10 bg-gray-900/50 border border-white/10 focus:border-blue-400 focus:ring-blue-400/30 rounded-xl text-white py-3 transition-all duration-300 shadow-sm hover:bg-gray-800/80"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                                placeholder="Minimal 8 karakter"
                            />
                        </div>
                        <p v-if="form.errors.password" class="mt-2 text-sm text-red-500">{{ form.errors.password }}</p>
                    </div>

                    <!-- Confirm Password Input -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                            </div>
                            <input
                                id="password_confirmation"
                                type="password"
                                class="block w-full pl-10 bg-gray-900/50 border border-white/10 focus:border-blue-400 focus:ring-blue-400/30 rounded-xl text-white py-3 transition-all duration-300 shadow-sm hover:bg-gray-800/80"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                                placeholder="Ulangi password"
                            />
                        </div>
                        <p v-if="form.errors.password_confirmation" class="mt-2 text-sm text-red-500">{{ form.errors.password_confirmation }}</p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button
                            type="submit"
                            class="w-full relative flex items-center justify-center bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/30 transform transition hover:-translate-y-0.5"
                            :class="{ 'opacity-70 cursor-not-allowed': form.processing }"
                            :disabled="form.processing"
                        >
                            <span v-if="!form.processing">Daftar Akun</span>
                            <span v-else class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>

                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-400">
                            Sudah punya akun? 
                            <Link :href="route('login')" class="font-bold text-blue-400 hover:text-blue-300 transition">Log In di sini</Link>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
