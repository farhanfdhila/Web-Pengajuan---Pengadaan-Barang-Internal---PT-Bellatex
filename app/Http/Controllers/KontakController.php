<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class KontakController extends Controller
{
    public function index()
    {
        $users = User::orderBy('role')->orderBy('name')->get(['id', 'name', 'role', 'no_hp']);
        
        return Inertia::render('Kontak', [
            'users' => $users
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hanya izinkan hapus jika no_hp kosong
        if (!empty($user->no_hp)) {
            return back()->with('error', 'Hanya bisa menghapus pengguna yang tidak memiliki nomor WhatsApp.');
        }

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }

}
