<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Fakultas::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_fakultas', 'LIKE', "%{$search}%")
                    ->orWhere('nama_fakultas', 'LIKE', "%{$search}%")
                    ->orWhere('dekan_fakultas', 'LIKE', "%{$search}%");
            });
        }

        $fakultas = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $total = Fakultas::count();
        $aktif = Fakultas::where('status_fakultas',true)->count();
        $nonaktif = Fakultas::where('status_fakultas',false)->count();

        return view('admin.fakultas.index', compact('fakultas', 'total', 'aktif', 'nonaktif'));
        // $fakultas = Fakultas::latest()->paginate(10);
        // return view('admin.fakultas.index', compact('fakultas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_fakultas'   => 'required|string|max:10|unique:fakultas,kode_fakultas',
            'nama_fakultas'   => 'required|string|max:150',
            'dekan_fakultas'  => 'nullable|string|max:150',
            'email_fakultas'  => 'nullable|email|max:150',
            'notelp_fakultas' => 'nullable|string|max:20',
            'status_fakultas' => 'required|boolean',
        ]);

        Fakultas::create($validated);

        return redirect()
            ->route('admin.fakultas.index')
            ->with('success', 'Data fakultas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        return view('admin.fakultas.show', compact('fakultas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        return view('admin.fakultas.edit', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $validated = $request->validate([
            'kode_fakultas'   => 'required|string|max:10|unique:fakultas,kode_fakultas,' . $fakultas->id,
            'nama_fakultas'   => 'required|string|max:150',
            'dekan_fakultas'  => 'nullable|string|max:150',
            'email_fakultas'  => 'nullable|email|max:150',
            'notelp_fakultas' => 'nullable|string|max:20',
            'status_fakultas' => 'required|boolean',
        ]);

        $fakultas->update($validated);

        return redirect()
            ->route('admin.fakultas.index')
            ->with('success', 'Data fakultas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fakultas = Fakultas::findOrFail($id);

        $fakultas->delete();

        return redirect()
            ->route('admin.fakultas.index')
            ->with('success', 'Data fakultas berhasil dihapus.');
    }
}
