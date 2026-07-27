<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JenisReviewer;
use App\Models\Reviewer;
use Illuminate\Http\Request;

class ReviewerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Reviewer::with(['jenisreviewer', 'dosen']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_reviewer', 'LIKE', "%{$search}%")
                    ->orWhere('nama_reviewer', 'LIKE', "%{$search}%")
                    ->orWhere('nidn_reviewer', 'LIKE', "%{$search}%")
                    ->orWhere('instansi_reviewer', 'LIKE', "%{$search}%");
            });
        }

        // Filter by jenis reviewer
        if ($request->filled('jenisreviewer_id')) {
            $query->where('jenisreviewer_id', $request->jenisreviewer_id);
        }

        $reviewer = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik
        $total = Reviewer::count();
        $aktif = Reviewer::where('status_reviewer', true)->count();
        $nonaktif = Reviewer::where('status_reviewer', false)->count();

        // Untuk filter
        $jenisReviewer = JenisReviewer::where('status_jenisreviewer', true)->get();

        return view('admin.reviewer.index', compact('reviewer', 'total', 'aktif', 'nonaktif', 'jenisReviewer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisReviewer = JenisReviewer::where('status_jenisreviewer', true)->get();
        $dosen = Dosen::where('status_dosen', true)->get();
        return view('admin.reviewer.create', compact('jenisReviewer', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_reviewer' => 'required|string|max:20|unique:reviewer,kode_reviewer',
            'nama_reviewer' => 'required|string|max:255',
            'nidn_reviewer' => 'nullable|string|max:20',
            'instansi_reviewer' => 'nullable|string|max:255',
            'email_reviewer' => 'nullable|email|max:255',
            'notelp_reviewer' => 'nullable|string|max:20',
            'alamat_reviewer' => 'nullable',
            'status_reviewer' => 'required|boolean',
            'jenisreviewer_id' => 'required|exists:jenisreviewer,id',
            'dosen_id' => 'nullable|exists:dosen,id',
        ]);

        Reviewer::create($request->all());

        return redirect()->route('admin.reviewer.index')
            ->with('success', 'Reviewer berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reviewer = Reviewer::with(['jenisReviewer', 'dosen'])->findOrFail($id);
        return view('admin.reviewer.show', compact('reviewer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jenisReviewer = JenisReviewer::where('status_jenisreviewer', true)->get();
        $dosen = Dosen::where('status_dosen', true)->get();
        $reviewer = Reviewer::with(['jenisReviewer', 'dosen'])->findOrFail($id);
        return view('admin.reviewer.edit', compact('reviewer', 'jenisReviewer', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_reviewer' => 'required|string|max:20|unique:reviewer,kode_reviewer,' . $reviewer->id,
            'nama_reviewer' => 'required|string|max:255',
            'nidn_reviewer' => 'nullable|string|max:20',
            'instansi_reviewer' => 'nullable|string|max:255',
            'email_reviewer' => 'nullable|email|max:255',
            'notelp_reviewer' => 'nullable|string|max:20',
            'alamat_reviewer' => 'nullable',
            'status_reviewer' => 'required|boolean',
            'jenisreviewer_id' => 'required|exists:jenisreviewer,id',
            'dosen_id' => 'nullable|exists:dosen,id',
        ]);

        $reviewer = Reviewer::with(['jenisReviewer', 'dosen'])->findOrFail($id);
        $reviewer->update($request->all());

        return redirect()->route('admin.reviewer.index')
            ->with('success', 'Reviewer berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reviewer = Reviewer::with(['jenisReviewer', 'dosen'])->findOrFail($id);
        $reviewer->delete();

        return redirect()->route('admin.reviewer.index')
            ->with('success', 'Reviewer berhasil dihapus!');
    }
}
