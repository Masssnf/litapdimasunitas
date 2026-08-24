<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalAnggota;
use App\Models\ProposalMahasiswa;
use App\Models\ProposalDokumen;
use App\Models\ProposalReviewer;
use App\Models\PeriodeSkema;
use App\Models\Dosen;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\BidangPenelitian;
use App\Models\Reviewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Proposal::with(['periodeSkema', 'ketuaDosen', 'fakultas', 'prodi', 'bidangPenelitian']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_proposal', 'LIKE', "%{$search}%")
                    ->orWhere('judul', 'LIKE', "%{$search}%")
                    ->orWhere('kata_kunci', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $proposal = $query->orderBy('created_at', 'desc')->paginate(10);

        // ✅ Statistik dengan status uppercase sesuai migration
        $total = Proposal::count();
        $draft = Proposal::where('status', 'Draft')->count();
        $diajukan = Proposal::where('status', 'Diajukan')->count();
        $diverifikasi = Proposal::where('status', 'Diverifikasi')->count();
        $direview = Proposal::where('status', 'Direview')->count();
        $revisi = Proposal::where('status', 'Revisi')->count();
        $lolos = Proposal::where('status', 'Lolos')->count();
        $ditolak = Proposal::where('status', 'Ditolak')->count();

        $periodeSkema = PeriodeSkema::with(['periode', 'skema'])->where('status', true)->get();

        return view('admin.proposal.index', compact(
            'proposal',
            'total',
            'draft',
            'diajukan',
            'diverifikasi',
            'direview',
            'revisi',
            'lolos',
            'ditolak',
            'periodeSkema'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periodeSkema = PeriodeSkema::with(['periode', 'skema'])->where('status', true)->get();
        $dosen = Dosen::where('status_dosen', true)->get();
        $fakultas = Fakultas::where('status_fakultas', true)->get();
        $prodi = Prodi::where('status_prodi', true)->get();
        $bidangPenelitian = BidangPenelitian::where('status_bidang', true)->get();

        // Generate kode proposal otomatis
        $kodeProposal = 'PR-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        // Cek duplikasi
        while (Proposal::where('kode_proposal', $kodeProposal)->exists()) {
            $kodeProposal = 'PR-' . date('Y') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        }

        return view('admin.proposal.create', compact(
            'periodeSkema',
            'dosen',
            'fakultas',
            'prodi',
            'bidangPenelitian',
            'kodeProposal'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ✅ Validasi dengan status uppercase
        $request->validate([
            'kode_proposal' => 'required|string|max:20|unique:proposal,kode_proposal',
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'kata_kunci' => 'nullable|string|max:255',
            'dana_diusulkan' => 'nullable|numeric|min:0',
            'status' => 'required|in:Draft,Diajukan,Diverifikasi,Direview,Revisi,Lolos,Ditolak',
            'tanggal_pengajuan' => 'required|date',
            'periode_skema_id' => 'required|exists:periode_skema,id',
            'ketua_dosen_id' => 'required|exists:dosen,id',
            'bidangpenelitian_id' => 'required|exists:bidangpenelitian,id',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $proposal = Proposal::create($request->all());

        return redirect()
            ->route('admin.proposal.show', $proposal->id)
            ->with('success', 'Proposal berhasil ditambahkan! Silakan tambahkan anggota, mahasiswa, dan dokumen.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // ✅ Perbaiki 'review History' menjadi 'reviewHistory'
        $proposal = Proposal::with([
            'periodeSkema.periode',
            'periodeSkema.skema',
            'ketuaDosen',
            'fakultas',
            'prodi',
            'bidangPenelitian',
            'anggota.dosen',
            'mahasiswa',
            'dokumen',
            'reviewer.reviewer',
            'reviewHistory.reviewer'  // ✅ Perbaiki: hapus spasi
        ])->findOrFail($id);

        return view('admin.proposal.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);

        $periodeSkema = PeriodeSkema::with(['periode', 'skema'])->where('status', true)->get();
        $dosen = Dosen::where('status_dosen', true)->get();
        $fakultas = Fakultas::where('status_fakultas', true)->get();
        $prodi = Prodi::where('status_prodi', true)->get();
        $bidangPenelitian = BidangPenelitian::where('status_bidang', true)->get();

        return view('admin.proposal.edit', compact(
            'proposal',
            'periodeSkema',
            'dosen',
            'fakultas',
            'prodi',
            'bidangPenelitian'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        // ✅ Validasi dengan status uppercase
        $request->validate([
            'kode_proposal' => 'required|string|max:20|unique:proposal,kode_proposal,' . $proposal->id,
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'kata_kunci' => 'nullable|string|max:255',
            'dana_diusulkan' => 'nullable|numeric|min:0',
            'status' => 'required|in:Draft,Diajukan,Diverifikasi,Direview,Revisi,Lolos,Ditolak',
            'tanggal_pengajuan' => 'required|date',
            'periode_skema_id' => 'required|exists:periode_skema,id',
            'ketua_dosen_id' => 'required|exists:dosen,id',
            'bidangpenelitian_id' => 'required|exists:bidangpenelitian,id',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $proposal->update($request->all());

        return redirect()
            ->route('admin.proposal.show', $proposal->id)
            ->with('success', 'Proposal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proposal = Proposal::with('dokumen')->findOrFail($id);

        // ✅ Hapus file dokumen dari storage
        foreach ($proposal->dokumen as $dokumen) {
            if (Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
        }

        $proposal->delete();

        return redirect()
            ->route('admin.proposal.index')
            ->with('success', 'Proposal berhasil dihapus!');
    }

    // =============================================
    // UPDATE STATUS (WORKFLOW)
    // =============================================

    public function updateStatus(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        // ✅ Validasi dengan status uppercase
        $request->validate([
            'status' => 'required|in:Draft,Diajukan,Diverifikasi,Direview,Revisi,Lolos,Ditolak',
        ]);

        $proposal->update(['status' => $request->status]);

        return redirect()
            ->route('admin.proposal.show', $proposal->id)
            ->with('success', 'Status proposal berhasil diubah menjadi "' . $request->status . '".');
    }
}
