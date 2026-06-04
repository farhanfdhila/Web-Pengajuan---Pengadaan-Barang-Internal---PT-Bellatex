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
    <Head title="Tentang Kami - PT Bellatex" />

    <div class="min-h-screen bg-gradient-to-br from-gray-900 via-[#111827] to-slate-900 text-gray-100 font-sans selection:bg-blue-500 selection:text-white flex flex-col relative overflow-hidden">
        <!-- Navigation -->
        <nav class="border-b border-white/10 bg-gray-900/50 backdrop-blur-xl sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-6 sm:px-8">
                <div class="flex justify-between h-20 items-center">
                    <div class="flex items-center gap-3">
                        <img src="/images/logo.png" alt="Logo" class="h-10 w-auto sm:h-12" onerror="this.outerHTML='<span class=\'text-2xl font-bold text-white\'>BX</span>'" />
                    </div>
                    
                    <!-- Desktop Menu -->
                    <div class="hidden md:flex gap-8 items-center">
                        <Link href="/" class="text-gray-300 hover:text-blue-400 font-semibold transition">Beranda</Link>
                        <Link :href="route('about')" class="text-blue-400 font-bold border-b-2 border-blue-400 pb-1">Tentang Kami</Link>
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
                    <Link href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-blue-400 hover:bg-gray-800/50">Beranda</Link>
                    <Link :href="route('about')" class="block px-3 py-2 rounded-md text-base font-bold text-blue-400 bg-blue-900/20">Tentang Kami</Link>
                    
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

        <!-- Content -->
        <main class="flex-grow py-20 relative overflow-hidden">
            <!-- Background Glows -->
            <div class="absolute top-0 left-0 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-96 h-96 bg-purple-600 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>

            <div class="max-w-4xl mx-auto px-6 sm:px-8 relative z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-8 text-center">PT Bellatex Jaya Maju Bersama</h1>
                
                <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 md:p-12 shadow-[0_8px_30px_rgb(0,0,0,0.12)] leading-relaxed text-lg text-gray-300">
                    <p class="mb-6">
                        PT Bellatex Jaya Maju Bersama adalah perusahaan tekstil terkemuka yang berdedikasi tinggi dalam menghasilkan produk-produk berkualitas untuk memenuhi kebutuhan industri garmen dan masyarakat luas. Sejak didirikan, kami selalu mengedepankan inovasi, presisi, dan kepuasan pelanggan.
                    </p>
                    <p class="mb-6">
                        Portal ini (Sistem Pengadaan Internal) dikembangkan sebagai wujud nyata dari komitmen kami menuju digitalisasi perusahaan. Melalui sistem yang terpusat ini, alur rantai pasok internal—mulai dari karyawan pabrik yang membutuhkan perlengkapan, hingga proses persetujuan oleh manajer dan pengeluaran barang oleh admin gudang—menjadi sepenuhnya transparan, cepat, dan bebas dari penggunaan kertas (Paperless).
                    </p>
                    <div class="mt-12">
                        <div class="border-l-4 border-[#001C8A] pl-4">
                            <h3 class="text-xl font-bold text-white mb-2">Visi Misi</h3>
                            <p class="text-gray-400 text-base">Membantu & Mensejahterakan lingkungan sekitar terutama bagi kaum yatim piatu & fakir miskin</p>
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
