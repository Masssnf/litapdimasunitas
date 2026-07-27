<?php

namespace App\Http\Controllers;

use App\Models\JenisSkema;
use App\Models\Skema;
use Illuminate\Http\Request;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Skema::with('jenisskema');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_skema', 'LIKE', "%{$search}%")
                    ->orWhere('nama_skema', 'LIKE', "%{$search}%")
                    ->orWhere('deskripsi_skema', 'LIKE', "%{$search}%");
            });
        }

        // Filter by jenis skema
        if ($request->filled('jenisskema_id')) {
            $query->where('jenisskema_id', $request->jenisskema_id);
        }

        $skema = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $total = Skema::count();
        $aktif = Skema::where('status_skema', true)->count();
        $nonaktif = Skema::where('status_skema', false)->count();

        // Untuk filter
        $jenisSkema = JenisSkema::where('status_jenisskema', true)->get();

        return view('admin.skema.index', compact('skema', 'total', 'aktif', 'nonaktif', 'jenisSkema'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisSkema = JenisSkema::where('status_jenisskema', true)->get();
        return view('admin.skema.create', compact('jenisSkema'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_skema' => 'required|unique:skema,kode_skema',
            'nama_skema' => 'required',
            'jenisskema_id' => 'required|exists:jenisskema,id',
            'dana_minimalskema' => 'required|numeric|min:0',
            'dana_maksimalskema' => 'required|numeric|min:0|gte:dana_minimalskema',
            'durasi_bulan' => 'required|integer|min:1',
        ]);

        Skema::create($request->all());
        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $skema = Skema::with('jenisskema')->findOrFail($id);
        return view('admin.skema.show', compact('skema'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skema = Skema::with('jenisskema')->findOrFail($id);
        $jenisSkema = JenisSkema::where('status_jenisskema', true)->get();
        return view('admin.skema.edit', compact('skema', 'jenisSkema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_skema' => 'required|unique:skema,kode_skema,' . $id,
            'nama_skema' => 'required',
            'jenisskema_id' => 'required|exists:jenisskema,id',
            'dana_minimalskema' => 'required|numeric|min:0',
            'dana_maksimalskema' => 'required|numeric|min:0|gte:dana_minimalskema',
            'durasi_bulan' => 'required|integer|min:1',
        ]);

        $skema = Skema::with('jenisskema')->findOrFail($id);
        $skema->update($request->all());
        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $skema = Skema::with('jenisskema')->findOrFail($id);
        $skema->delete();
        return redirect()->route('admin.skema.index')->with('success', 'Skema berhasil dihapus.');
    }
}
