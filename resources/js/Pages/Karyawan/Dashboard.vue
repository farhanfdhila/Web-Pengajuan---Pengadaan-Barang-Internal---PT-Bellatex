<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Karyawan Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-gray-100 leading-tight tracking-tight">Dashboard Karyawan</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 overflow-hidden shadow-xl sm:rounded-3xl">
                    <div class="p-8 text-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400">Selamat datang di Portal Pengadaan</h3>
                            <Link :href="route('karyawan.permintaan.create')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white font-bold py-3 px-6 rounded-full shadow-lg shadow-blue-900/50 transform transition hover:-translate-y-1 duration-300 inline-block">
                                + Buat Permintaan
                            </Link>
                        </div>
                        <p class="mb-4 text-gray-400 font-medium text-lg">Gunakan portal ini untuk mencari barang di katalog dan mengajukan permintaan ke bagian approval.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                            <Link :href="route('karyawan.katalog')" class="bg-gray-900/50 border border-white/10 rounded-2xl p-8 hover:-translate-y-2 hover:shadow-2xl hover:shadow-blue-900/30 transition-all duration-300 cursor-pointer group block">
                                <div class="w-12 h-12 rounded-xl bg-blue-900/50 text-blue-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <h4 class="text-2xl font-bold mb-2 text-white group-hover:text-blue-400 transition-colors">Katalog Barang</h4>
                                <p class="text-base text-gray-400">Lihat daftar barang yang tersedia beserta stok saat ini.</p>
                            </Link>
                            <Link :href="route('karyawan.riwayat')" class="bg-gray-900/50 border border-white/10 rounded-2xl p-8 hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-900/30 transition-all duration-300 cursor-pointer group block">
                                <div class="w-12 h-12 rounded-xl bg-indigo-900/50 text-indigo-400 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <h4 class="text-2xl font-bold mb-2 text-white group-hover:text-indigo-400 transition-colors">Riwayat Permintaan</h4>
                                <p class="text-base text-gray-400">Pantau status permintaan barang Anda (Pending, Approved, Rejected).</p>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
