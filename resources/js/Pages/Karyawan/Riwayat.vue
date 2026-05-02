<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    permintaans: Array
});
</script>

<template>
    <Head title="Riwayat Permintaan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Riwayat Permintaan</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="py-3 px-4">Tanggal</th>
                                        <th class="py-3 px-4">Keterangan</th>
                                        <th class="py-3 px-4">Detail Barang</th>
                                        <th class="py-3 px-4">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in permintaans" :key="p.id" class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                                        <td class="py-3 px-4">{{ new Date(p.tanggal_permintaan).toLocaleDateString('id-ID') }}</td>
                                        <td class="py-3 px-4">{{ p.keterangan || '-' }}</td>
                                        <td class="py-3 px-4">
                                            <ul class="list-disc pl-4 text-sm">
                                                <li v-for="d in p.details" :key="d.id">
                                                    {{ d.barang.nama_barang }} ({{ d.jumlah }} {{ d.barang.satuan }})
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="py-1 px-3 rounded-full text-xs font-semibold"
                                                :class="{
                                                    'bg-yellow-500/20 text-yellow-400': p.status === 'pending',
                                                    'bg-green-500/20 text-green-400': p.status === 'approved' || p.status === 'processed',
                                                    'bg-red-500/20 text-red-400': p.status === 'rejected',
                                                    'bg-blue-500/20 text-blue-400': p.status === 'revised'
                                                }"
                                            >
                                                {{ p.status.toUpperCase() }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr v-if="permintaans.length === 0">
                                        <td colspan="4" class="py-8 text-center opacity-50">Belum ada riwayat permintaan.</td>
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
