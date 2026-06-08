<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const greeting = ref('');

onMounted(() => {
    const hour = new Date().getHours();
    if (hour < 11) greeting.value = 'Selamat Pagi';
    else if (hour < 15) greeting.value = 'Selamat Siang';
    else if (hour < 18) greeting.value = 'Selamat Sore';
    else greeting.value = 'Selamat Malam';
});

const props = defineProps({
    permintaans: Array
});

const showRevisiModal = ref(false);
const selectedId = ref(null);

const revisiForm = useForm({
    catatan: ''
});

const openRevisiModal = (id) => {
    selectedId.value = id;
    showRevisiModal.value = true;
};

const closeRevisiModal = () => {
    showRevisiModal.value = false;
    revisiForm.reset();
};

const submitRevisi = () => {
    revisiForm.post(route('approval.permintaan.revisi', selectedId.value), {
        onSuccess: () => closeRevisiModal()
    });
};

const updateStatus = (id, status) => {
    router.post(route('approval.permintaan.validasi', id), { status });
};
</script>

<template>
    <Head title="Approval Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ greeting }}, H. Rohmani</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.12)] sm:rounded-3xl">
                    <div class="p-6 text-gray-100">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="text-lg font-bold">Antrean Persetujuan</h3>
                                <p class="opacity-80 mt-1">Tinjau permintaan barang dari karyawan di bawah ini.</p>
                            </div>
                            <Link :href="route('approval.pengguna.index')" class="bg-[#424242] hover:bg-[#2e2e2e] text-white px-4 py-2 rounded shadow transition text-sm font-semibold flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Kelola Pengguna
                            </Link>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-white/10">
                                        <th class="py-3 px-4">Tanggal</th>
                                        <th class="py-3 px-4">Pemohon</th>
                                        <th class="py-3 px-4">Alasan Permintaan</th>
                                        <th class="py-3 px-4">Detail Item</th>
                                        <th class="py-3 px-4">Status</th>
                                        <th class="py-3 px-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="p in permintaans" :key="p.id" class="border-b border-white/10 hover:bg-gray-700/30 transition">
                                        <td class="py-3 px-4">{{ new Date(p.tanggal_permintaan).toLocaleDateString('id-ID') }}</td>
                                        <td class="py-3 px-4 font-semibold text-blue-400">{{ p.user.name }}</td>
                                        <td class="py-3 px-4">{{ p.keterangan || '-' }}</td>
                                        <td class="py-3 px-4">
                                            <ul class="list-disc pl-4 text-sm">
                                                <li v-for="d in p.details" :key="d.id">
                                                    {{ d.barang.nama_barang }} ({{ d.jumlah }} {{ d.barang.satuan }})
                                                </li>
                                            </ul>
                                        </td>
                                        <td class="py-3 px-4">
                                            <span class="py-1 px-3 rounded-full text-xs font-semibold uppercase tracking-wider"
                                                :class="{
                                                    'bg-yellow-500/20 text-yellow-400': p.status === 'pending',
                                                    'bg-green-500/20 text-green-400': p.status === 'approved' || p.status === 'processed',
                                                    'bg-red-500/20 text-red-400': p.status === 'rejected',
                                                    'bg-blue-500/20 text-blue-400': p.status === 'revised'
                                                }"
                                            >
                                                {{ p.status }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex gap-2" v-if="p.status === 'pending'">
                                                <button @click="updateStatus(p.id, 'approved')" class="text-sm bg-green-600/90 hover:bg-green-500 text-white py-1.5 px-3 rounded shadow transition">Setujui</button>
                                                <button @click="updateStatus(p.id, 'rejected')" class="text-sm bg-red-600/90 hover:bg-red-500 text-white py-1.5 px-3 rounded shadow transition">Tolak</button>
                                                <button @click="openRevisiModal(p.id)" class="text-sm bg-yellow-600/90 hover:bg-yellow-500 text-white py-1.5 px-3 rounded shadow transition">Revisi</button>
                                            </div>
                                            <div v-else class="text-sm text-gray-500 italic">
                                                Selesai
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="permintaans.length === 0">
                                        <td colspan="6" class="py-8 text-center opacity-50">Belum ada antrean persetujuan.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revisi Modal -->
        <div v-if="showRevisiModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="bg-gray-800 p-6 rounded-xl shadow-2xl max-w-md w-full border border-gray-700">
                <h3 class="text-lg font-bold text-white mb-4">Berikan Catatan Revisi</h3>
                <form @submit.prevent="submitRevisi">
                    <textarea v-model="revisiForm.catatan" class="w-full bg-gray-900 border border-gray-600 rounded-lg text-white mb-4 focus:ring-yellow-500 focus:border-yellow-500" rows="4" placeholder="Tulis catatan revisi di sini..." required></textarea>
                    <div class="flex justify-end gap-3">
                        <button type="button" @click="closeRevisiModal" class="px-4 py-2 text-sm text-gray-300 hover:text-white transition">Batal</button>
                        <button type="submit" :disabled="revisiForm.processing" class="bg-yellow-600 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg shadow transition">Kirim Revisi</button>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
