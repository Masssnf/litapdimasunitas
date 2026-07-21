<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Prodi::with('fakultas');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_prodi', 'LIKE', "%{$search}%")
                    ->orWhere('nama_prodi', 'LIKE', "%{$search}%")
                    ->orWhere('kaprodi', 'LIKE', "%{$search}%");
            });
        }

        // Filter by fakultas
        if ($request->filled('fakultas_id')) {
            $query->where('fakultas_id', $request->fakultas_id);
        }

        $prodi = $query->orderBy('created_at', 'desc')->paginate(10);

        // ✅ STATISTIK - PASTIKAN SEMUA VARIABEL TERDEFINISI
        $total = Prodi::count();
        $aktif = Prodi::where('status_prodi', true)->count();
        $nonaktif = Prodi::where('status_prodi', false)->count();

        // Untuk filter
        $fakultas = Fakultas::where('status_fakultas', true)->get();

        return view('admin.prodi.index', compact('prodi', 'total', 'aktif', 'nonaktif', 'fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas', 'asc')->get();

        return view('admin.prodi.create', compact('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'kode_prodi' => 'required|unique:prodi',
            'nama_prodi' => 'required',
            'jenjang_prodi' => 'required',
            'kaprodi' => 'nullable',
            'email_prodi' => 'nullable|email',
            'notelp_prodi' => 'nullable',
            'status_prodi' => 'required|boolean'
        ]);

        Prodi::create($validated);

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Data Program Studi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $prodi = Prodi::with('fakultas')->findOrFail($id);

        return view('admin.prodi.show', compact('prodi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $fakultas = Fakultas::orderBy('nama_fakultas', 'asc')->get();

        return view('admin.prodi.edit', compact('prodi', 'fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $validated = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'kode_prodi' => 'required|unique:prodi,kode_prodi,' . $prodi->id,
            'nama_prodi' => 'required',
            'jenjang_prodi' => 'required',
            'kaprodi' => 'nullable',
            'email_prodi' => 'nullable|email',
            'notelp_prodi' => 'nullable',
            'status_prodi' => 'required|boolean'
        ]);

        $prodi->update($validated);

        return redirect()->route('admin.prodi.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prodi = Prodi::findOrFail($id);

        $prodi->delete();

        return redirect()
            ->route('admin.prodi.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
