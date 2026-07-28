<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\PeriodeSkema;
use App\Models\Skema;
use Illuminate\Http\Request;

class PeriodeSkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PeriodeSkema::with(['periode', 'skema']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('periode', function ($q) use ($search) {
                    $q->where('nama_periode', 'LIKE', "%{$search}%")
                        ->orWhere('kode_periode', 'LIKE', "%{$search}%");
                })->orWhereHas('skema', function ($q) use ($search) {
                    $q->where('nama_skema', 'LIKE', "%{$search}%")
                        ->orWhere('kode_skema', 'LIKE', "%{$search}%");
                })->orWhere('kuota_proposal', 'LIKE', "%{$search}%");
            });
        }

        $periodeSkema = $query->latest()->paginate(10);

        // Statistik
        $total = PeriodeSkema::count();
        $aktif = PeriodeSkema::where('status', true)->count();
        $nonaktif = PeriodeSkema::where('status', false)->count();
        $totalSkema = Skema::where('status_skema', true)->count();

        return view('admin.periodeskema.index', compact('periodeSkema', 'total', 'aktif', 'nonaktif', 'totalSkema'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periode = Periode::where('status_periode', 1)
            ->orderBy('tahun_anggaran', 'desc')
            ->get();

        $skema = Skema::where('status_skema', 1)
            ->orderBy('nama_skema')
            ->get();

        return view('admin.periodeskema.create', compact('periode', 'skema'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'periode_id' => 'required|exists:periode,id',
            'skema_id' => 'required|exists:skema,id',
            'tanggal_mulai_pengajuan' => 'required|date',
            'tanggal_selesai_pengajuan' => 'required|date|after_or_equal:tanggal_mulai_pengajuan',
            'tanggal_mulai_review' => 'nullable|date',
            'tanggal_selesai_review' => 'nullable|date|after_or_equal:tanggal_mulai_review',
            'tanggal_pengumuman' => 'nullable|date',
            'kuota_proposal' => 'required|integer|min:1',
            'dana_minimal' => 'required|numeric|min:0',
            'dana_maksimal' => 'required|numeric|gte:dana_minimal',
            'maksimal_anggota' => 'required|integer|min:1',
            'luaran_wajib' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'keterangan' => 'nullable|string',
        ]);

        PeriodeSkema::create($validated);

        return redirect()
            ->route('admin.periodeskema.index')
            ->with('success', 'Periode Skema berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $periodeSkema = PeriodeSkema::with(['periode', 'skema'])->findOrFail($id);

        return view('admin.periodeskema.show', compact('periodeSkema'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $periodeSkema = PeriodeSkema::with(['periode', 'skema'])->findOrFail($id);

        $periode = Periode::where('status_periode', 1)
            ->orderBy('tahun_anggaran', 'desc')
            ->get();

        $skema = Skema::where('status_skema', 1)
            ->orderBy('nama_skema')
            ->get();

        return view('admin.periodeskema.edit', compact('periodeSkema', 'periode', 'skema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $periodeSkema = PeriodeSkema::findOrFail($id);

        $validated = $request->validate([
            'periode_id' => 'required|exists:periode,id',
            'skema_id' => 'required|exists:skema,id',
            'tanggal_mulai_pengajuan' => 'required|date',
            'tanggal_selesai_pengajuan' => 'required|date|after_or_equal:tanggal_mulai_pengajuan',
            'tanggal_mulai_review' => 'nullable|date',
            'tanggal_selesai_review' => 'nullable|date|after_or_equal:tanggal_mulai_review',
            'tanggal_pengumuman' => 'nullable|date',
            'kuota_proposal' => 'required|integer|min:1',
            'dana_minimal' => 'required|numeric|min:0',
            'dana_maksimal' => 'required|numeric|gte:dana_minimal',
            'maksimal_anggota' => 'required|integer|min:1',
            'luaran_wajib' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'keterangan' => 'nullable|string',
        ]);

        $periodeSkema->update($validated);

        return redirect()
            ->route('admin.periodeskema.index')
            ->with('success', 'Periode Skema berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periodeSkema = PeriodeSkema::findOrFail($id);
        $periodeSkema->delete();

        return redirect()
            ->route('admin.periodeskema.index')
            ->with('success', 'Periode Skema berhasil dihapus.');
    }
}
