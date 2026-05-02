<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    barangs: Array
});

const form = useForm({
    keterangan: '',
    items: [
        { barang_id: '', jumlah: 1 }
    ]
});

const addItem = () => {
    form.items.push({ barang_id: '', jumlah: 1 });
};

const removeItem = (index) => {
    form.items.splice(index, 1);
};

const submit = () => {
    form.post(route('karyawan.permintaan.store'));
};
</script>

<template>
    <Head title="Buat Permintaan" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Buat Permintaan Barang</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit" class="space-y-6">
                            
                            <div>
                                <label class="block font-medium mb-1">Keterangan / Alasan Permintaan</label>
                                <textarea v-model="form.keterangan" class="w-full bg-gray-900 border-gray-700 rounded-md text-white" rows="3"></textarea>
                            </div>

                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block font-medium">Daftar Barang</label>
                                    <button type="button" @click="addItem" class="text-sm bg-blue-600 hover:bg-blue-500 text-white py-1 px-3 rounded">+ Tambah Item</button>
                                </div>
                                
                                <div v-for="(item, index) in form.items" :key="index" class="flex flex-col sm:flex-row gap-4 mb-4 sm:items-end bg-gray-700/30 p-4 rounded-lg border border-gray-700/50 shadow-inner">
                                    <div class="flex-1">
                                        <label class="block text-sm font-semibold mb-1 text-gray-300">Pilih Barang</label>
                                        <select v-model="item.barang_id" class="w-full bg-gray-900 border border-gray-600 focus:border-blue-500 focus:ring-blue-500 rounded-md text-white shadow-sm" required>
                                            <option value="" disabled>-- Silakan Pilih Barang --</option>
                                            <option v-for="b in barangs" :key="b.id" :value="b.id">{{ b.nama_barang }} (Sisa Stok: {{ b.stok }})</option>
                                        </select>
                                    </div>
                                    <div class="w-full sm:w-32">
                                        <label class="block text-sm font-semibold mb-1 text-gray-300">Jumlah</label>
                                        <input type="number" v-model="item.jumlah" min="1" class="w-full bg-gray-900 border border-gray-600 focus:border-blue-500 focus:ring-blue-500 rounded-md text-white shadow-sm" required>
                                    </div>
                                    <div class="flex justify-end sm:justify-start">
                                        <button type="button" @click="removeItem(index)" class="bg-red-600/90 hover:bg-red-500 text-white px-4 py-2 rounded-md shadow transition flex items-center justify-center h-[42px]" v-if="form.items.length > 1">
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-4 border-t border-gray-700 flex justify-end">
                                <button type="submit" :disabled="form.processing" class="bg-gradient-to-r from-[#001C8A] to-[#424242] hover:from-[#001466] hover:to-[#2e2e2e] text-white font-bold py-2 px-6 rounded-lg shadow transition">
                                    Kirim Permintaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
