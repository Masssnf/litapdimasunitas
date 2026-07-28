<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Periode::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_periode', 'LIKE', "%{$search}%")
                    ->orWhere('nama_periode', 'LIKE', "%{$search}%")
                    ->orWhere('tahun_anggaran', 'LIKE', "%{$search}%");
            });
        }

        $periode = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $total = Periode::count();
        $aktif = Periode::where('status_periode', true)->count();
        $nonaktif = Periode::where('status_periode', false)->count();
        $tahunAnggaran = Periode::distinct('tahun_anggaran')->count('tahun_anggaran');

        return view('admin.periode.index', compact('periode', 'total', 'aktif', 'nonaktif', 'tahunAnggaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.periode.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_periode' => 'required|string|max:20|unique:periode,kode_periode',
            'nama_periode' => 'required|string|max:255',
            'tahun_anggaran' => 'required|string|max:10',
            'semester' => 'required|in:Ganjil,Genap',
            'keterangan_periode' => 'nullable|string',
            'status_periode' => 'required|boolean',
        ]);

        Periode::create($validated);

        return redirect()
            ->route('admin.periode.index')
            ->with('success', 'Data periode berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        return view('admin.periode.show', compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $periode)
    {
        return view('admin.periode.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        $validated = $request->validate([
            'kode_periode' => 'required|string|max:20|unique:periode,kode_periode,' . $periode->id,
            'nama_periode' => 'required|string|max:255',
            'tahun_anggaran' => 'required|string|max:10',
            'semester' => 'required|in:Ganjil,Genap',
            'keterangan_periode' => 'nullable|string',
            'status_periode' => 'required|boolean',
        ]);

        $periode->update($validated);

        return redirect()
            ->route('admin.periode.index')
            ->with('success', 'Data periode berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        $periode->delete();

        return redirect()
            ->route('admin.periode.index')
            ->with('success', 'Data periode berhasil dihapus.');
    }
}
