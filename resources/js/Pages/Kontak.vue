<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    users: {
        type: Array,
        required: true
    }
});

const page = usePage();
const isApproval = computed(() => page.props.auth?.user?.role === 'approval');

const getRoleBadgeClass = (role) => {
    if (role === 'admin') return 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 border-red-200';
    if (role === 'approval') return 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400 border-purple-200';
    return 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 border-blue-200';
};

const getCleanWhatsAppNumber = (number) => {
    if (!number) return '';
    return number.toString().replace(/\D/g, '');
};

const deleteForm = useForm({});

const hapusKontak = (user) => {
    if (!confirm(`Hapus pengguna "${user.name}" dari direktori kontak?\n\nPengguna ini tidak memiliki nomor WhatsApp terdaftar.\nTindakan ini tidak dapat dibatalkan.`)) return;
    deleteForm.delete(route('kontak.destroy', user.id), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Kontak Pengguna" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Kontak Pengguna</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.12)] sm:rounded-3xl">
                    <div class="p-6 text-gray-100">
                        <div class="mb-6">
                            <h3 class="text-2xl font-extrabold text-blue-400 mb-2">Direktori Kontak</h3>
                            <p class="text-gray-400">Daftar kontak WhatsApp seluruh pengguna sistem (Admin, Approval, Karyawan).</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="user in users" :key="user.id" class="border border-white/10 rounded-2xl p-6 bg-gray-900/50 hover:shadow-[0_8px_30px_rgb(0,0,0,0.2)] transition-shadow duration-300">
                                <div class="flex items-start justify-between mb-4">
                                    <div>
                                        <h4 class="font-bold text-lg text-white">{{ user.name }}</h4>
                                        <span :class="['inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border mt-1 capitalize', getRoleBadgeClass(user.role)]">
                                            {{ user.role }}
                                        </span>
                                    </div>
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-[#001C8A] to-[#424242] flex items-center justify-center text-white font-bold text-lg shadow-inner">
                                        {{ user.name.charAt(0).toUpperCase() }}
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-white/10">
                                    <p class="text-sm text-gray-400 mb-3">
                                        <span class="block text-xs font-semibold uppercase tracking-wider mb-1">Nomor WhatsApp</span>
                                        {{ user.no_hp || 'Belum diatur' }}
                                    </p>
                                    
                                    <a v-if="user.no_hp" :href="'https://wa.me/' + getCleanWhatsAppNumber(user.no_hp)" target="_blank" class="w-full flex justify-center items-center gap-2 bg-[#25D366] hover:bg-[#1ebd5a] text-white py-2 px-4 rounded-xl font-bold transition shadow-md hover:shadow-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                                        </svg>
                                        Chat WA
                                    </a>
                                    <div v-else class="flex flex-col gap-2">
                                        <div class="w-full flex justify-center items-center gap-2 bg-gray-700 text-gray-400 py-2 px-4 rounded-xl font-bold cursor-not-allowed select-none">
                                            Tidak ada WA
                                        </div>
                                        <button
                                            v-if="isApproval"
                                            @click="hapusKontak(user)"
                                            :disabled="deleteForm.processing"
                                            class="w-full flex justify-center items-center gap-2 bg-red-600 hover:bg-red-700 disabled:opacity-60 disabled:cursor-not-allowed text-white py-2 px-4 rounded-xl font-bold transition shadow-md hover:shadow-lg"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                            {{ deleteForm.processing ? 'Menghapus...' : 'Hapus Pengguna' }}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div v-if="users.length === 0" class="text-center py-10 text-gray-500">
                            Belum ada data kontak.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
