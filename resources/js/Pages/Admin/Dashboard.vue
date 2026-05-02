<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const greeting = ref('');

onMounted(() => {
    const hour = new Date().getHours();
    if (hour < 11) greeting.value = 'Selamat Pagi';
    else if (hour < 15) greeting.value = 'Selamat Siang';
    else if (hour < 18) greeting.value = 'Selamat Sore';
    else greeting.value = 'Selamat Malam';
});

defineProps({
    stats: Object
});
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-extrabold text-2xl text-gray-100 leading-tight tracking-tight">{{ greeting }}, Bambang Suprayitno</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 overflow-hidden shadow-xl sm:rounded-3xl mb-6">
                    <div class="p-8 text-gray-100">
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 gap-4">
                            <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400">Ringkasan Sistem</h3>
                            <div class="flex flex-wrap gap-3">
                                <Link :href="route('admin.barang.index')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 text-white px-5 py-2.5 rounded-full shadow-lg shadow-blue-900/50 transform transition hover:-translate-y-0.5 text-sm font-bold">Kelola Data Barang</Link>
                                <Link :href="route('admin.pengeluaran.index')" class="bg-gray-800/50 border border-blue-500/30 text-blue-400 hover:bg-gray-700 px-5 py-2.5 rounded-full shadow-sm transition transform hover:-translate-y-0.5 text-sm font-bold">Proses Pengeluaran</Link>
                                <Link :href="route('admin.laporan.index')" class="bg-blue-900/20 border border-blue-800/50 text-blue-300 hover:bg-blue-900/40 px-5 py-2.5 rounded-full shadow-sm transition transform hover:-translate-y-0.5 text-sm font-bold">Cetak Laporan</Link>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white p-8 rounded-2xl shadow-xl shadow-blue-900/20 transform hover:-translate-y-1 transition-all duration-300 group border border-white/10">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 bg-white/10 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                </div>
                                <div class="text-4xl font-extrabold mb-1">{{ stats?.total_barang || 0 }}</div>
                                <div class="text-sm font-medium text-blue-200">Total Jenis Barang</div>
                            </div>
                            <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white p-8 rounded-2xl shadow-xl shadow-indigo-900/20 transform hover:-translate-y-1 transition-all duration-300 group border border-white/10">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 bg-white/10 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                                <div class="text-4xl font-extrabold mb-1">{{ stats?.selesai || 0 }}</div>
                                <div class="text-sm font-medium text-indigo-200">Permintaan Selesai</div>
                            </div>
                            <div class="bg-gradient-to-br from-purple-600 to-purple-800 text-white p-8 rounded-2xl shadow-xl shadow-purple-900/20 transform hover:-translate-y-1 transition-all duration-300 group border border-white/10">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="p-3 bg-white/10 rounded-xl backdrop-blur-sm group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                </div>
                                <div class="text-4xl font-extrabold mb-1">{{ stats?.menunggu || 0 }}</div>
                                <div class="text-sm font-medium text-purple-200">Menunggu Diproses</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
