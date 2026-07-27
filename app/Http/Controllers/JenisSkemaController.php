<?php

namespace App\Http\Controllers;

use App\Models\JenisSkema;
use Illuminate\Http\Request;

class JenisSkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JenisSkema::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_jenisskema', 'LIKE', "%{$search}%")
                    ->orWhere('nama_jenisskema', 'LIKE', "%{$search}%");
            });
        }

        $jenisskema = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $total = JenisSkema::count();
        $aktif = JenisSkema::where('status_jenisskema', true)->count();
        $nonaktif = JenisSkema::where('status_jenisskema', false)->count();

        return view('admin.jenisskema.index', compact('jenisskema', 'total', 'aktif', 'nonaktif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenisskema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_jenisskema' => 'required|string|max:20|unique:jenisskema,kode_jenisskema',
            'nama_jenisskema' => 'required|string|max:255',
            'status_jenisskema' => 'required|boolean',
            'deskripsi_jenisskema' => 'nullable',
        ]);

        JenisSkema  ::create($request->all());

        return redirect()->route('admin.jenisskema.index')
            ->with('success', 'Jenis Skema berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view ('admin.jenisskema.show', [
            'jenisskema' => JenisSkema::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.jenisskema.edit', [
            'jenisskema' => JenisSkema::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_jenisskema' => 'required|string|max:20|unique:jenisskema,kode_jenisskema,' . $id,
            'nama_jenisskema' => 'required|string|max:255',
            'status_jenisskema' => 'required|boolean',
            'deskripsi_jenisskema' => 'nullable',
        ]);

        $jenisskema = JenisSkema::findOrFail($id);
        $jenisskema->update($request->all());

        return redirect()->route('admin.jenisskema.index')
            ->with('success', 'Jenis Skema berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisskema = JenisSkema::findOrFail($id);
        $jenisskema->delete();

        return redirect()->route('admin.jenisskema.index')
            ->with('success', 'Jenis Skema berhasil dihapus!');
    }
}
