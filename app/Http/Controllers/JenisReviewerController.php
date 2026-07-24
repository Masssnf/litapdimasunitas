<?php

namespace App\Http\Controllers;

use App\Models\JenisReviewer;
use Illuminate\Http\Request;

class JenisReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JenisReviewer::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_jenisreviewer', 'LIKE', "%{$search}%")
                    ->orWhere('nama_jenisreviewer', 'LIKE', "%{$search}%");
            });
        }

        $jenisReviewer = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $total = JenisReviewer::count();
        $aktif = JenisReviewer::where('status_jenisreviewer', true)->count();
        $nonaktif = JenisReviewer::where('status_jenisreviewer', false)->count();

        return view('admin.jenisreviewer.index', compact('jenisReviewer', 'total', 'aktif', 'nonaktif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jenisreviewer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_jenisreviewer' => 'required|string|max:20|unique:jenisreviewer,kode_jenisreviewer',
            'nama_jenisreviewer' => 'required|string|max:255',
            'status_jenisreviewer' => 'required|boolean',
        ]);

        JenisReviewer::create($request->all());

        return redirect()->route('admin.jenisreviewer.index')
            ->with('success', 'Jenis Reviewer berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisReviewer $jenisreviewer)
    {
        return view('admin.jenisreviewer.show', compact('jenisreviewer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisReviewer $jenisreviewer)
    {
        return view('admin.jenisreviewer.edit', compact('jenisreviewer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisReviewer $jenisreviewer)
    {
        $request->validate([
            'kode_jenisreviewer' => 'required|string|max:20|unique:jenisreviewer,kode_jenisreviewer,' . $jenisreviewer->id,
            'nama_jenisreviewer' => 'required|string|max:255',
            'status_jenisreviewer' => 'required|boolean',
        ]);

        $jenisreviewer->update($request->all());

        return redirect()->route('admin.jenisreviewer.index')
            ->with('success', 'Jenis Reviewer berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisReviewer $jenisreviewer)
    {
        $jenisreviewer->delete();

        return redirect()->route('admin.jenisreviewer.index')
            ->with('success', 'Jenis Reviewer berhasil dihapus!');
    }
}
