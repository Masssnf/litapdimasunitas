<?php

namespace App\Http\Controllers;

use App\Models\BidangPenelitian;
use Illuminate\Http\Request;

class BidangPenelitianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = BidangPenelitian::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_bidang', 'LIKE', "%{$search}%")
                    ->orWhere('nama_bidang', 'LIKE', "%{$search}%");
            });
        }

        $bidangpenelitian = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $total = BidangPenelitian::count();
        $aktif = BidangPenelitian::where('status_bidang', true)->count();
        $nonaktif = BidangPenelitian::where('status_bidang', false)->count();

        return view('admin.bidangpenelitian.index', compact('bidangpenelitian', 'total', 'aktif', 'nonaktif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bidangpenelitian.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bidang'   => 'required|string|max:10|unique:bidangpenelitian,kode_bidang',
            'nama_bidang'   => 'required|string|max:150',
            'deskripsi_bidang' => 'nullable|string|max:255',
            'status_bidang' => 'required|boolean',
        ]);

        BidangPenelitian::create($validated);

        return redirect()
            ->route('admin.bidangpenelitian.index')
            ->with('success', 'Data Bidang Penelitian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bidangpenelitian = BidangPenelitian::findOrFail($id);

        return view('admin.bidangpenelitian.show', compact('bidangpenelitian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bidangpenelitian = BidangPenelitian::findOrFail($id);

        return view('admin.bidangpenelitian.edit', compact('bidangpenelitian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bidangpenelitian = BidangPenelitian::findOrFail($id);

        $validated = $request->validate([
            'kode_bidang'   => 'required|string|max:10|unique:bidangpenelitian,kode_bidang,' . $bidangpenelitian->id,
            'nama_bidang'   => 'required|string|max:150',
            'deskripsi_bidang' => 'nullable|string|max:255',
            'status_bidang' => 'required|boolean',
        ]);

        $bidangpenelitian->update($validated);

        return redirect()
            ->route('admin.bidangpenelitian.index')
            ->with('success', 'Data Bidang Penelitian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bidangpenelitian = BidangPenelitian::findOrFail($id);

        $bidangpenelitian->delete();

        return redirect()
            ->route('admin.bidangpenelitian.index')
            ->with('success', 'Data Bidang Penelitian berhasil dihapus.');
    }
}
