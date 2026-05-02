<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const mobileMenuOpen = ref(false);
</script>

<template>
    <Head title="Beranda - PT Bellatex" />

    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-[#111827] to-slate-900 text-gray-100 font-sans selection:bg-blue-500 selection:text-white flex flex-col relative overflow-hidden">
        <!-- Navigation -->
        <nav class="border-b border-white/10 bg-gray-900/50 backdrop-blur-xl sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 sm:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <img src="/images/logo.png" alt="Logo" class="h-10 w-auto sm:h-12" onerror="this.outerHTML='<span class=\'text-2xl font-bold text-gray-900\'>BX</span>'" />
                    </div>
                    
                    <!-- Desktop Menu -->
                    <div class="hidden md:flex gap-8 items-center">
                        <Link href="/" class="text-blue-400 font-bold border-b-2 border-blue-400 pb-1">Beranda</Link>
                        <Link :href="route('about')" class="text-gray-300 hover:text-blue-400 font-semibold transition">Tentang Kami</Link>
                        <div v-if="canLogin" class="flex gap-4 ml-4">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-lg shadow-blue-900/50 hover:shadow-blue-900/70 hover:-translate-y-0.5">Buka Dashboard</Link>
                            <template v-else>
                                <Link :href="route('login')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-6 py-2.5 rounded-full font-bold transition-all shadow-lg shadow-blue-900/50 hover:shadow-blue-900/70 hover:-translate-y-0.5">Log In</Link>
                                <Link v-if="canRegister" :href="route('register')" class="bg-gray-800/50 hover:bg-gray-800 text-blue-400 border border-blue-500/50 px-6 py-2.5 rounded-full font-bold transition-all shadow-sm hover:shadow-md ml-2 hover:-translate-y-0.5">Daftar</Link>
                            </template>
                        </div>
                    </div>

                    <!-- Mobile Hamburger -->
                    <div class="md:hidden flex items-center">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-300 hover:text-white focus:outline-none">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="mobileMenuOpen ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div v-if="mobileMenuOpen" class="md:hidden bg-gray-900/95 backdrop-blur-lg border-b border-white/10 shadow-md absolute w-full">
                <div class="px-4 pt-2 pb-6 space-y-2">
                    <Link href="/" class="block px-3 py-2 rounded-md text-base font-bold text-blue-400 bg-blue-900/20">Beranda</Link>
                    <Link :href="route('about')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-blue-400 hover:bg-gray-800/50">Tentang Kami</Link>
                    
                    <div v-if="canLogin" class="mt-4 pt-4 border-t border-gray-800">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="block w-full text-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-5 py-3 rounded-xl font-semibold transition shadow-md">Buka Dashboard</Link>
                        <template v-else>
                            <Link :href="route('login')" class="block w-full text-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-xl font-bold mb-3 shadow-md">Log In</Link>
                            <Link v-if="canRegister" :href="route('register')" class="block w-full text-center bg-gray-800/50 border border-blue-500/30 text-blue-400 px-6 py-3 rounded-xl font-bold">Daftar</Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow flex items-center relative overflow-hidden">
            <!-- Background Glows -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-purple-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

            <div class="max-w-7xl mx-auto px-6 sm:px-8 relative z-10 w-full">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-blue-600 text-sm font-bold mb-6 shadow-sm">
                            <span class="relative flex h-2.5 w-2.5">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-600"></span>
                            </span>
                            Sistem Pengadaan Internal v2.0
                        </div>
                        <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-[1.1] mb-6">
                            Transformasi <br />
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">Digitalisasi</span> <br />
                            Gudang.
                        </h1>
                        <p class="text-lg md:text-xl text-gray-600 mb-8 leading-relaxed max-w-lg font-medium">
                            Platform eksklusif bagi karyawan PT Bellatex Jaya Maju Bersama untuk mempermudah alur pengajuan, validasi, hingga pengeluaran stok barang.
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-8 py-3.5 rounded-full font-bold text-lg transition-all shadow-lg shadow-blue-900/50 hover:shadow-blue-900/70 hover:-translate-y-1">
                                Buka Dashboard
                            </Link>
                            <Link v-else :href="route('login')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-8 py-3.5 rounded-full font-bold text-lg transition-all shadow-lg shadow-blue-900/50 hover:shadow-blue-900/70 hover:-translate-y-1">
                                Masuk Sistem
                            </Link>
                            <Link :href="route('about')" class="bg-gray-800/50 border border-gray-700 hover:border-blue-500/50 text-gray-300 hover:text-blue-400 px-8 py-3.5 rounded-full font-bold text-lg transition-all shadow-sm hover:shadow-md hover:-translate-y-1">
                                Pelajari Lebih Lanjut
                            </Link>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <!-- Abstract Visual representation of dashboard/warehouse -->
                        <div class="relative w-full aspect-square max-w-md mx-auto">
                            <div class="absolute inset-0 bg-gradient-to-tr from-blue-600 to-purple-600 rounded-3xl opacity-30 transform rotate-6 scale-105 animate-pulse"></div>
                            <div class="absolute inset-0 bg-gray-800/40 backdrop-blur-xl border border-white/10 rounded-3xl shadow-2xl p-6 flex flex-col gap-4 transform -rotate-3 transition-transform hover:rotate-0 duration-500">
                                <div class="flex justify-between items-center">
                                    <div class="h-8 w-1/3 bg-gray-700 rounded-lg animate-pulse"></div>
                                    <div class="h-8 w-8 bg-blue-500/30 rounded-full"></div>
                                </div>
                                <div class="grid grid-cols-2 gap-4 mt-4">
                                    <div class="h-32 bg-gradient-to-br from-blue-900/50 to-indigo-900/50 border border-blue-500/20 rounded-2xl shadow-inner"></div>
                                    <div class="h-32 bg-gray-700/50 border border-gray-600/50 rounded-2xl shadow-sm"></div>
                                </div>
                                <div class="h-4 w-full bg-gray-700 rounded mt-auto"></div>
                                <div class="h-4 w-2/3 bg-gray-700 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-t border-white/10 bg-gray-900/50 backdrop-blur-sm py-8 text-center text-sm font-medium text-gray-400 relative z-10">
            &copy; {{ new Date().getFullYear() }} PT Bellatex Jaya Maju Bersama. Hak Cipta Dilindungi.
        </footer>
    </div>
</template>
