<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Barang;
use App\Models\Permintaan;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang' => Barang::count(),
            'selesai' => Permintaan::where('status', 'processed')->count(),
            'menunggu' => Permintaan::where('status', 'approved')->count(),
        ];
        return Inertia::render('Admin/Dashboard', ['stats' => $stats]);
    }

    public function barang()
    {
        $barangs = Barang::all();
        return Inertia::render('Admin/Barang', ['barangs' => $barangs]);
    }

    public function storeBarang(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string',
            'harga_satuan' => 'required|numeric|min:0'
        ]);

        $lastBarang = Barang::orderBy('id', 'desc')->first();
        $nextId = $lastBarang ? $lastBarang->id + 1 : 1;
        $validated['kode_barang'] = 'BRG-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        Barang::create($validated);
        return back()->with('success', 'Barang berhasil ditambahkan.');
    }

    public function updateBarang(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $validated = $request->validate([
            'kode_barang' => 'required|string|unique:barangs,kode_barang,' . $id,
            'nama_barang' => 'required|string',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string',
            'harga_satuan' => 'required|numeric|min:0'
        ]);

        $barang->update($validated);
        return back()->with('success', 'Data barang berhasil diubah.');
    }

    public function destroyBarang($id)
    {
        Barang::findOrFail($id)->delete();
        return back()->with('success', 'Barang berhasil dihapus.');
    }

    public function pengeluaran()
    {
        $permintaans = Permintaan::whereIn('status', ['approved', 'processed'])
            ->with('user', 'details.barang')
            ->orderBy('updated_at', 'desc')
            ->get();
        return Inertia::render('Admin/Pengeluaran', ['permintaans' => $permintaans]);
    }

    public function prosesPengeluaran(Request $request, $id)
    {
        $permintaan = Permintaan::with('details.barang')->findOrFail($id);

        if ($permintaan->status !== 'approved') {
            return back()->with('error', 'Permintaan belum disetujui atau sudah diproses.');
        }

        // Cek ketersediaan stok
        foreach ($permintaan->details as $detail) {
            if ($detail->barang->stok < $detail->jumlah) {
                return back()->with('error', 'Stok ' . $detail->barang->nama_barang . ' tidak mencukupi.');
            }
        }

        DB::transaction(function () use ($permintaan) {
            // Kurangi stok
            foreach ($permintaan->details as $detail) {
                $detail->barang->decrement('stok', $detail->jumlah);
            }

            // Ubah status
            $permintaan->update(['status' => 'processed']);

            // Catat pengeluaran
            Pengeluaran::create([
                'permintaan_id' => $permintaan->id,
                'user_id' => auth()->id(),
                'tanggal_pengeluaran' => now(),
                'keterangan' => 'Barang telah dikeluarkan dari gudang.'
            ]);
        });

        return back()->with('success', 'Pengeluaran barang berhasil diproses.');
    }

    public function laporan()
    {
        $laporan = Permintaan::where('status', 'processed')
            ->with('user', 'details.barang')
            ->orderBy('updated_at', 'desc')
            ->get();
        return Inertia::render('Admin/Laporan', ['laporan' => $laporan]);
    }
}
