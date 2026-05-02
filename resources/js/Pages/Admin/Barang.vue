<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({ barangs: Array });

const showModal = ref(false);
const isEditing = ref(false);

const form = useForm({
    id: null,
    kode_barang: '',
    nama_barang: '',
    deskripsi: '',
    stok: 0,
    satuan: '',
    harga_satuan: 0
});

const openCreateModal = () => {
    isEditing.value = false;
    form.reset();
    showModal.value = true;
};

const openEditModal = (b) => {
    isEditing.value = true;
    form.id = b.id;
    form.kode_barang = b.kode_barang;
    form.nama_barang = b.nama_barang;
    form.deskripsi = b.deskripsi;
    form.stok = b.stok;
    form.satuan = b.satuan;
    form.harga_satuan = b.harga_satuan;
    showModal.value = true;
};

const submit = () => {
    if (isEditing.value) {
        form.put(route('admin.barang.update', form.id), { onSuccess: () => showModal.value = false });
    } else {
        form.post(route('admin.barang.store'), { onSuccess: () => showModal.value = false });
    }
};

const deleteBarang = (id) => {
    if (confirm('Yakin ingin menghapus barang ini?')) {
        router.delete(route('admin.barang.destroy', id));
    }
};
</script>

<template>
    <Head title="Kelola Barang" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Kelola Data Barang</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold">Daftar Barang (Katalog)</h3>
                            <button @click="openCreateModal" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded shadow transition">
                                + Tambah Barang
                            </button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="py-3 px-4">Kode</th>
                                        <th class="py-3 px-4">Nama Barang</th>
                                        <th class="py-3 px-4">Stok</th>
                                        <th class="py-3 px-4">Satuan</th>
                                        <th class="py-3 px-4">Harga (Rp)</th>
                                        <th class="py-3 px-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="b in barangs" :key="b.id" class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                                        <td class="py-3 px-4">{{ b.kode_barang }}</td>
                                        <td class="py-3 px-4 font-semibold text-blue-400">{{ b.nama_barang }}</td>
                                        <td class="py-3 px-4">{{ b.stok }}</td>
                                        <td class="py-3 px-4">{{ b.satuan }}</td>
                                        <td class="py-3 px-4">{{ b.harga_satuan }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex gap-2">
                                                <button @click="openEditModal(b)" class="text-sm bg-yellow-600/90 hover:bg-yellow-500 text-white py-1.5 px-3 rounded shadow transition">Edit</button>
                                                <button @click="deleteBarang(b.id)" class="text-sm bg-red-600/90 hover:bg-red-500 text-white py-1.5 px-3 rounded shadow transition">Hapus</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="barangs.length === 0">
                                        <td colspan="6" class="py-8 text-center opacity-50">Data barang masih kosong.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="bg-gray-800 p-6 rounded-xl shadow-2xl max-w-lg w-full border border-gray-700 max-h-[90vh] overflow-y-auto">
                <h3 class="text-lg font-bold text-white mb-4">{{ isEditing ? 'Edit Barang' : 'Tambah Barang' }}</h3>
                <form @submit.prevent="submit" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div v-if="isEditing">
                            <label class="block text-sm text-gray-300 mb-1">Kode Barang</label>
                            <input v-model="form.kode_barang" type="text" class="w-full bg-gray-900 border-gray-600 rounded text-white" disabled>
                        </div>
                        <div v-else>
                            <label class="block text-sm text-gray-300 mb-1">Kode Barang</label>
                            <input type="text" value="Otomatis dibuat (BRG-...)" class="w-full bg-gray-900 border-gray-600 rounded text-gray-500 cursor-not-allowed" disabled>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Nama Barang</label>
                            <input v-model="form.nama_barang" type="text" class="w-full bg-gray-900 border-gray-600 rounded text-white" required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm text-gray-300 mb-1">Deskripsi</label>
                            <textarea v-model="form.deskripsi" class="w-full bg-gray-900 border-gray-600 rounded text-white" rows="2"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Stok Awal</label>
                            <input v-model="form.stok" type="number" min="0" class="w-full bg-gray-900 border-gray-600 rounded text-white" required>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-300 mb-1">Satuan (Pcs/Botol/dll)</label>
                            <input v-model="form.satuan" type="text" class="w-full bg-gray-900 border-gray-600 rounded text-white" required>
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm text-gray-300 mb-1">Harga Satuan (Rp)</label>
                            <input v-model="form.harga_satuan" type="number" min="0" class="w-full bg-gray-900 border-gray-600 rounded text-white" required>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" @click="showModal = false" class="px-4 py-2 text-sm text-gray-300 hover:text-white transition">Batal</button>
                        <button type="submit" :disabled="form.processing" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow transition">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
