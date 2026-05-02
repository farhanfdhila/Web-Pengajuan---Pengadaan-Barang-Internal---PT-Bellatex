<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Barang;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        return Inertia::render('Karyawan/Dashboard');
    }

    public function katalog()
    {
        $barangs = Barang::all();
        return Inertia::render('Karyawan/Katalog', ['barangs' => $barangs]);
    }

    public function createPermintaan()
    {
        $barangs = Barang::all();
        return Inertia::render('Karyawan/FormPermintaan', ['barangs' => $barangs]);
    }

    public function storePermintaan(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request) {
            $permintaan = Permintaan::create([
                'user_id' => auth()->id(),
                'tanggal_permintaan' => now(),
                'status' => 'pending',
                'keterangan' => $request->keterangan
            ]);

            foreach ($request->items as $item) {
                PermintaanDetail::create([
                    'permintaan_id' => $permintaan->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah']
                ]);
            }
        });

        return redirect()->route('karyawan.riwayat')->with('success', 'Permintaan berhasil diajukan.');
    }

    public function riwayat()
    {
        $permintaans = Permintaan::where('user_id', auth()->id())->with('details.barang')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Karyawan/Riwayat', ['permintaans' => $permintaans]);
    }
}
