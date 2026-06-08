<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    pengguna: Array,
});

const showModal = ref(false);
const isEditing = ref(false);
const selectedId = ref(null);

const form = useForm({
    name: '',
    email: '',
    role: 'karyawan',
    password: '',
    password_confirmation: ''
});

const openModal = (user = null) => {
    if (user) {
        isEditing.value = true;
        selectedId.value = user.id;
        form.name = user.name;
        form.email = user.email;
        form.role = user.role;
        form.password = '';
        form.password_confirmation = '';
    } else {
        isEditing.value = false;
        selectedId.value = null;
        form.reset();
    }
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    form.reset();
    form.clearErrors();
};

const submitForm = () => {
    if (isEditing.value) {
        form.put(route('approval.pengguna.update', selectedId.value), {
            onSuccess: () => closeModal()
        });
    } else {
        form.post(route('approval.pengguna.store'), {
            onSuccess: () => closeModal()
        });
    }
};

const deleteUser = (id) => {
    if (confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')) {
        router.delete(route('approval.pengguna.destroy', id));
    }
};
</script>

<template>
    <Head title="Kelola Pengguna" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Kelola Data Pengguna</h2>
                <button @click="openModal()" class="bg-[#001C8A] hover:bg-[#001466] text-white px-4 py-2 rounded shadow transition text-sm font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Pengguna
                </button>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Session Messages -->
                <div v-if="$page.props.flash?.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                </div>
                <div v-if="$page.props.flash?.error" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $page.props.flash.error }}</span>
                </div>

                <div class="bg-gray-800/40 backdrop-blur-2xl border border-white/10 overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.12)] sm:rounded-3xl">
                    <div class="p-6 text-gray-100">
                        <h3 class="text-lg font-bold mb-4">Daftar Admin & Karyawan</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-white/10 bg-gray-900/30">
                                        <th class="py-3 px-4 font-semibold">Nama Lengkap</th>
                                        <th class="py-3 px-4 font-semibold">Email</th>
                                        <th class="py-3 px-4 font-semibold">Peran (Role)</th>
                                        <th class="py-3 px-4 font-semibold">Terdaftar Pada</th>
                                        <th class="py-3 px-4 font-semibold text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in pengguna" :key="user.id" class="border-b border-white/10 hover:bg-gray-700/30 transition">
                                        <td class="py-3 px-4 font-semibold text-blue-400">{{ user.name }}</td>
                                        <td class="py-3 px-4">{{ user.email }}</td>
                                        <td class="py-3 px-4">
                                            <span class="py-1 px-3 rounded-full text-xs font-semibold uppercase tracking-wider"
                                                :class="{
                                                    'bg-purple-500/20 text-purple-400': user.role === 'admin',
                                                    'bg-green-500/20 text-green-400': user.role === 'karyawan',
                                                }"
                                            >
                                                {{ user.role }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-sm">{{ new Date(user.created_at).toLocaleDateString('id-ID') }}</td>
                                        <td class="py-3 px-4 text-right space-x-2">
                                            <button @click="openModal(user)" class="text-blue-400 hover:text-blue-300 font-medium text-sm transition">Edit</button>
                                            <button @click="deleteUser(user.id)" class="text-red-400 hover:text-red-300 font-medium text-sm transition">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr v-if="pengguna.length === 0">
                                        <td colspan="5" class="py-8 text-center opacity-50">Belum ada data pengguna admin atau karyawan.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create/Edit -->
        <div v-if="showModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true" @click="closeModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-700">
                    <form @submit.prevent="submitForm">
                        <div class="px-6 pt-6 pb-4">
                            <h3 class="text-xl font-bold text-white mb-6">{{ isEditing ? 'Edit Data Pengguna' : 'Tambah Pengguna Baru' }}</h3>
                            
                            <div class="space-y-4">
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                                    <input v-model="form.name" type="text" class="w-full bg-gray-900 border border-gray-600 rounded-lg text-white px-4 py-2 focus:border-[#001C8A] focus:ring-[#001C8A]" required>
                                    <p v-if="form.errors.name" class="text-red-400 text-xs mt-1">{{ form.errors.name }}</p>
                                </div>
                                
                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Alamat Email</label>
                                    <input v-model="form.email" type="email" class="w-full bg-gray-900 border border-gray-600 rounded-lg text-white px-4 py-2 focus:border-[#001C8A] focus:ring-[#001C8A]" required>
                                    <p v-if="form.errors.email" class="text-red-400 text-xs mt-1">{{ form.errors.email }}</p>
                                </div>

                                <!-- Role -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Peran (Role)</label>
                                    <select v-model="form.role" class="w-full bg-gray-900 border border-gray-600 rounded-lg text-white px-4 py-2 focus:border-[#001C8A] focus:ring-[#001C8A]" required>
                                        <option value="karyawan">Karyawan</option>
                                        <option value="admin">Admin Gudang</option>
                                    </select>
                                    <p v-if="form.errors.role" class="text-red-400 text-xs mt-1">{{ form.errors.role }}</p>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-1">
                                        Password <span v-if="isEditing" class="text-xs text-gray-500 font-normal">(Kosongkan jika tidak ingin mengubah password)</span>
                                    </label>
                                    <input v-model="form.password" type="password" class="w-full bg-gray-900 border border-gray-600 rounded-lg text-white px-4 py-2 focus:border-[#001C8A] focus:ring-[#001C8A]" :required="!isEditing">
                                    <p v-if="form.errors.password" class="text-red-400 text-xs mt-1">{{ form.errors.password }}</p>
                                </div>

                                <!-- Confirm Password -->
                                <div v-if="!isEditing || form.password">
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Konfirmasi Password</label>
                                    <input v-model="form.password_confirmation" type="password" class="w-full bg-gray-900 border border-gray-600 rounded-lg text-white px-4 py-2 focus:border-[#001C8A] focus:ring-[#001C8A]" :required="!isEditing || form.password">
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-900/50 border-t border-gray-700 flex justify-end gap-3">
                            <button type="button" @click="closeModal" class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white transition">Batal</button>
                            <button type="submit" class="bg-[#001C8A] hover:bg-[#001466] text-white px-6 py-2 rounded-lg text-sm font-bold shadow-lg transition disabled:opacity-50" :disabled="form.processing">
                                {{ isEditing ? 'Simpan Perubahan' : 'Tambahkan Pengguna' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
