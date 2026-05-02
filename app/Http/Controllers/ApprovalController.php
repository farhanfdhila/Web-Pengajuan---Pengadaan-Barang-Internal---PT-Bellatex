<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Permintaan;
use App\Models\Validasi;
use App\Models\Revisi;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::with('user', 'details.barang')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Approval/Dashboard', ['permintaans' => $permintaans]);
    }

    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $permintaan = Permintaan::findOrFail($id);

        DB::transaction(function () use ($request, $permintaan) {
            $permintaan->update(['status' => $request->status]);

            Validasi::create([
                'permintaan_id' => $permintaan->id,
                'user_id' => auth()->id(),
                'status_validasi' => $request->status,
            ]);
        });

        return back()->with('success', 'Permintaan telah ' . ($request->status === 'approved' ? 'disetujui' : 'ditolak') . '.');
    }

    public function revisi(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|string'
        ]);

        $permintaan = Permintaan::findOrFail($id);

        DB::transaction(function () use ($request, $permintaan) {
            $permintaan->update(['status' => 'revised']);

            Revisi::create([
                'permintaan_id' => $permintaan->id,
                'user_id' => auth()->id(),
                'catatan_revisi' => $request->catatan,
            ]);
            
            Validasi::create([
                'permintaan_id' => $permintaan->id,
                'user_id' => auth()->id(),
                'status_validasi' => 'revised',
            ]);
        });

        return back()->with('success', 'Catatan revisi telah dikirim.');
    }
}
