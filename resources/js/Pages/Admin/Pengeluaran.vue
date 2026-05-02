<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';

defineProps({
    permintaans: Array
});

const prosesPengeluaran = (id) => {
    if (confirm('Apakah Anda yakin barang sudah disiapkan dan siap dikeluarkan dari gudang? Stok akan otomatis dikurangi.')) {
        router.post(route('admin.pengeluaran.proses', id));
    }
};
</script>

<template>
    <Head title="Pengeluaran Barang" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Proses Pengeluaran Barang</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4">Daftar Permintaan Disetujui</h3>
                        <p class="opacity-80 mb-6">Permintaan di bawah ini sudah di-*Approve*. Silakan proses untuk memotong stok dan mencatat pengeluaran gudang.</p>
                        
                        <div v-if="$page.props.flash && $page.props.flash.error" class="mb-4 bg-red-500/20 text-red-400 p-4 rounded border border-red-500/50">
                            {{ $page.props.flash.error }}
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="py-3 px-4">Tgl Disetujui</th>
                                        <th class="py-3 px-4">Pemohon</th>
                                        <th class="py-3 px-4">Detail Barang Diambil</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in permintaans" :key="p.id" class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                                        <td class="py-3 px-4">{{ new Date(p.updated_at).toLocaleDateString('id-ID') }}</td>
                                        <td class="py-3 px-4 font-semibold text-emerald-400">{{ p.user.name }}</td>
                                        <td class="py-3 px-4">
                                            <ul class="list-disc pl-4 text-sm">
                                                <li v-for="d in p.details" :key="d.id" :class="{'text-red-400': d.barang.stok < d.jumlah}">
                                                    {{ d.barang.nama_barang }} ({{ d.jumlah }} {{ d.barang.satuan }}) 
                                                    <span class="text-xs opacity-70">- Stok Gudang: {{ d.barang.stok }}</span>
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="py-1 px-3 rounded-full text-xs font-semibold uppercase tracking-wider"
                                                :class="{
                                                    'bg-yellow-500/20 text-yellow-400': p.status === 'approved',
                                                    'bg-blue-500/20 text-blue-400': p.status === 'processed'
                                                }"
                                            >
                                                {{ p.status === 'approved' ? 'MENUNGGU PENGAMBILAN' : 'SELESAI (DIKELUARKAN)' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <button v-if="p.status === 'approved'" @click="prosesPengeluaran(p.id)" class="text-sm bg-purple-600/90 hover:bg-purple-500 text-white py-1.5 px-3 rounded shadow transition">
                                                Proses & Keluarkan
                                            </button>
                                            <span v-else class="text-sm text-gray-500 italic">Telah Diproses</span>
                                        </td>
                                    </tr>
                                    <tr v-if="permintaans.length === 0">
                                        <td colspan="5" class="py-8 text-center opacity-50">Tidak ada permintaan yang menunggu proses pengeluaran.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
