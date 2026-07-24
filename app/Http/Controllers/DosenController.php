<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dosen::with(['fakultas', 'prodi']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nidn', 'LIKE', "%{$search}%")
                    ->orWhere('nama_dosen', 'LIKE', "%{$search}%");
            });
        }

        $dosen = $query->orderBy('created_at', 'desc')->paginate(10);

        // ✅ STATISTIK - PASTIKAN SEMUA VARIABEL TERDEFINISI
        $total = Dosen::count();
        $aktif = Dosen::where('status_dosen', true)->count();
        $nonaktif = Dosen::where('status_dosen', false)->count();

        // Untuk filter
        $fakultas = Fakultas::where('status_fakultas', true)->get();
        $prodi = Prodi::where('status_prodi', true)->get();

        return view('admin.dosen.index', compact('dosen', 'total', 'aktif', 'nonaktif', 'fakultas', 'prodi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::orderBy('nama_fakultas', 'asc')->get();
        $prodi = Prodi::orderBy('nama_prodi', 'asc')->get();

        return view('admin.dosen.create', compact('fakultas', 'prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodi,id',
            'nama_dosen' => 'required',
            'alamat_dosen' => 'nullable',
            'jenis_kelamin' => 'required|in:L,P',
            'nidn' => 'required|unique:dosen',
            'email_dosen' => 'nullable|email',
            'notelp_dosen' => 'nullable',
            'status_dosen' => 'required|boolean'
        ]);

        Dosen::create($validated);

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data Dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dosen = Dosen::with(['fakultas', 'prodi'])->findOrFail($id);

        return view('admin.dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dosen = Dosen::with(['fakultas', 'prodi'])->findOrFail($id);

        $fakultas = Fakultas::orderBy('nama_fakultas', 'asc')->get();
        $prodi = Prodi::orderBy('nama_prodi', 'asc')->get();

        return view('admin.dosen.edit', compact('dosen', 'fakultas', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dosen = Dosen::findOrFail($id);

        $validated = $request->validate([
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodi,id',
            'nama_dosen' => 'required',
            'alamat_dosen' => 'nullable',
            'jenis_kelamin' => 'required|in:L,P',
            'nidn' => 'required|unique:dosen,nidn,' . $dosen->id,
            'email_dosen' => 'nullable|email',
            'notelp_dosen' => 'nullable',
            'status_dosen' => 'required|boolean'
        ]);

        $dosen->update($validated);

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data Dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect()
            ->route('admin.dosen.index')
            ->with('success', 'Data Dosen berhasil dihapus.');
    }
}
