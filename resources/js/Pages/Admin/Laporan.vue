<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    laporan: Array
});

const printLaporan = () => {
    window.print();
};
</script>

<template>
    <Head title="Rekap Laporan" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center print:hidden">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Rekap Laporan Pengeluaran</h2>
                <button @click="printLaporan" class="bg-[#001C8A] hover:bg-[#001466] text-white px-4 py-2 rounded shadow transition text-sm font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Laporan
                </button>
            </div>
        </template>

        <div class="py-12 print:py-0">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 print:px-0 print:max-w-none">
                <!-- Print Header (Hidden on screen) -->
                <div class="hidden print:block text-center mb-8 border-b-2 border-black pb-4 text-black">
                    <h1 class="text-2xl font-bold uppercase">PT Bellatex Jaya Maju Bersama</h1>
                    <p class="text-lg">Laporan Pengeluaran Barang Internal</p>
                    <p class="text-sm mt-2">Dicetak pada: {{ new Date().toLocaleDateString('id-ID') }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg print:shadow-none print:bg-transparent">
                    <div class="p-6 text-gray-900 dark:text-gray-100 print:text-black print:p-0">
                        <div class="overflow-x-auto print:overflow-visible">
                            <table class="w-full text-left border-collapse print:text-sm">
                                <thead>
                                    <tr class="border-b border-gray-700 print:border-black bg-gray-50 dark:bg-gray-700/50 print:bg-transparent">
                                        <th class="py-3 px-4 print:py-2 print:border-b-2 print:border-black">Tanggal Proses</th>
                                        <th class="py-3 px-4 print:py-2 print:border-b-2 print:border-black">Pemohon</th>
                                        <th class="py-3 px-4 print:py-2 print:border-b-2 print:border-black">Detail Barang Dikeluarkan</th>
                                        <th class="py-3 px-4 print:py-2 print:border-b-2 print:border-black">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in laporan" :key="p.id" class="border-b border-gray-700 print:border-gray-400 hover:bg-gray-700/50 transition print:hover:bg-transparent">
                                        <td class="py-3 px-4 print:py-2">{{ new Date(p.updated_at).toLocaleDateString('id-ID') }}</td>
                                        <td class="py-3 px-4 print:py-2 font-semibold text-blue-400 print:text-black">{{ p.user.name }}</td>
                                        <td class="py-3 px-4 print:py-2">
                                            <ul class="list-disc pl-4 text-sm print:text-xs">
                                                <li v-for="d in p.details" :key="d.id">
                                                    {{ d.barang.nama_barang }} ({{ d.jumlah }} {{ d.barang.satuan }})
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="py-3 px-4 print:py-2">{{ p.keterangan || '-' }}</td>
                                    </tr>
                                    <tr v-if="laporan.length === 0">
                                        <td colspan="4" class="py-8 text-center opacity-50">Belum ada data pengeluaran yang selesai.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Print Footer (Hidden on screen) -->
                        <div class="hidden print:block mt-20 text-right mr-12 text-black">
                            <p class="mb-20">Mengetahui, <br>Admin Gudang</p>
                            <p class="font-bold border-t border-black inline-block min-w-[150px] pt-1 text-center">{{ $page.props.auth.user.name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
