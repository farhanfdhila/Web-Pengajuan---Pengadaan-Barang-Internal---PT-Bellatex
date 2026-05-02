<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    barangs: Array
});
</script>

<template>
    <Head title="Katalog Barang" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Katalog Barang</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div v-for="barang in barangs" :key="barang.id" class="border border-gray-700 rounded-lg p-4 bg-gray-700/50 hover:bg-gray-700 transition">
                                <h4 class="text-lg font-bold text-blue-400">{{ barang.nama_barang }}</h4>
                                <p class="text-sm opacity-70 mb-2">{{ barang.kode_barang }}</p>
                                <p class="text-sm mb-4">{{ barang.deskripsi }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-semibold">Stok: {{ barang.stok }} {{ barang.satuan }}</span>
                                </div>
                            </div>
                            <div v-if="barangs.length === 0" class="col-span-full text-center py-8 opacity-50">
                                Belum ada barang di katalog.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
