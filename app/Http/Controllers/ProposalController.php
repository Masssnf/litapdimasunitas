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

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_proposal', 'LIKE', "%{$search}%")
                    ->orWhere('judul', 'LIKE', "%{$search}%")
                    ->orWhere('kata_kunci', 'LIKE', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by periode skema
        if ($request->filled('periode_skema_id')) {
            $query->where('periode_skema_id', $request->periode_skema_id);
        }

        $proposal = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistik berdasarkan status
        $total = Proposal::count();
        $draft = Proposal::where('status', 'draft')->count();
        $diajukan = Proposal::where('status', 'diajukan')->count();
        $direview = Proposal::where('status', 'direview')->count();
        $diterima = Proposal::where('status', 'diterima')->count();
        $ditolak = Proposal::where('status', 'ditolak')->count();
        $revisi = Proposal::where('status', 'revisi')->count();

        // Untuk filter
        $periodeSkema = PeriodeSkema::with(['periode', 'skema'])->where('status', true)->get();

        return view('admin.proposal.index', compact(
            'proposal',
            'total',
            'draft',
            'diajukan',
            'direview',
            'diterima',
            'ditolak',
            'revisi',
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

        return view('admin.proposal.create', compact(
            'periodeSkema',
            'dosen',
            'fakultas',
            'prodi',
            'bidangPenelitian'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // Proposal
            'kode_proposal' => 'required|string|max:20|unique:proposal,kode_proposal',
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'kata_kunci' => 'nullable|string|max:255',
            'dana_diusulkan' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,diajukan,direview,diterima,ditolak,revisi',
            'tanggal_pengajuan' => 'required|date',
            'periode_skema_id' => 'required|exists:periode_skema,id',
            'ketua_dosen_id' => 'required|exists:dosen,id',
            'bidangpenelitian_id' => 'required|exists:bidangpenelitian,id',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodi,id',

            // Anggota
            'anggota.*.dosen_id' => 'required|exists:dosen,id',
            'anggota.*.peran' => 'required|in:ketua,anggota',

            // Mahasiswa
            'mahasiswa.*.nim' => 'required|string|max:20',
            'mahasiswa.*.nama_mahasiswa' => 'required|string|max:255',
            'mahasiswa.*.prodi_mahasiswa' => 'required|string|max:100',

            // Dokumen
            'dokumen.*.jenis_dokumen' => 'required|string|max:50',
            'dokumen.*.file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        DB::beginTransaction();

        try {
            // 1. Simpan Proposal
            $proposal = Proposal::create($request->only([
                'kode_proposal',
                'judul',
                'ringkasan',
                'kata_kunci',
                'dana_diusulkan',
                'status',
                'tanggal_pengajuan',
                'periode_skema_id',
                'ketua_dosen_id',
                'bidangpenelitian_id',
                'fakultas_id',
                'prodi_id'
            ]));

            // 2. Simpan Anggota
            if ($request->has('anggota')) {
                foreach ($request->anggota as $anggota) {
                    ProposalAnggota::create([
                        'proposal_id' => $proposal->id,
                        'dosen_id' => $anggota['dosen_id'],
                        'peran' => $anggota['peran'],
                    ]);
                }
            }

            // 3. Simpan Mahasiswa
            if ($request->has('mahasiswa')) {
                foreach ($request->mahasiswa as $mahasiswa) {
                    ProposalMahasiswa::create([
                        'proposal_id' => $proposal->id,
                        'nim' => $mahasiswa['nim'],
                        'nama_mahasiswa' => $mahasiswa['nama_mahasiswa'],
                        'prodi_mahasiswa' => $mahasiswa['prodi_mahasiswa'],
                    ]);
                }
            }

            // 4. Simpan Dokumen
            if ($request->has('dokumen')) {
                foreach ($request->dokumen as $dokumen) {
                    $file = $dokumen['file'];
                    $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $filePath = $file->storeAs('proposal/dokumen/' . $proposal->id, $fileName, 'public');

                    ProposalDokumen::create([
                        'proposal_id' => $proposal->id,
                        'jenis_dokumen' => $dokumen['jenis_dokumen'],
                        'nama_file' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                        'file_size' => $file->getSize(),
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.proposal.index')
                ->with('success', 'Proposal berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Gagal menyimpan proposal: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
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
            'reviewer.reviewer'
        ])->findOrFail($id);

        return view('admin.proposal.show', compact('proposal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proposal = Proposal::with([
            'anggota.dosen',
            'mahasiswa',
            'dokumen',
            'reviewer.reviewer'
        ])->findOrFail($id);

        $periodeSkema = PeriodeSkema::with(['periode', 'skema'])->where('status', true)->get();
        $dosen = Dosen::where('status_dosen', true)->get();
        $fakultas = Fakultas::where('status_fakultas', true)->get();
        $prodi = Prodi::where('status_prodi', true)->get();
        $bidangPenelitian = BidangPenelitian::where('status_bidang', true)->get();
        $reviewer = Reviewer::where('status_reviewer', true)->get();

        return view('admin.proposal.edit', compact(
            'proposal',
            'periodeSkema',
            'dosen',
            'fakultas',
            'prodi',
            'bidangPenelitian',
            'reviewer'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'kode_proposal' => 'required|string|max:20|unique:proposal,kode_proposal,' . $proposal->id,
            'judul' => 'required|string|max:255',
            'ringkasan' => 'nullable|string',
            'kata_kunci' => 'nullable|string|max:255',
            'dana_diusulkan' => 'nullable|numeric|min:0',
            'status' => 'required|in:draft,diajukan,direview,diterima,ditolak,revisi',
            'tanggal_pengajuan' => 'required|date',
            'periode_skema_id' => 'required|exists:periode_skema,id',
            'ketua_dosen_id' => 'required|exists:dosen,id',
            'bidangpenelitian_id' => 'required|exists:bidangpenelitian,id',
            'fakultas_id' => 'required|exists:fakultas,id',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        DB::beginTransaction();

        try {
            // 1. Update Proposal
            $proposal->update($request->only([
                'kode_proposal',
                'judul',
                'ringkasan',
                'kata_kunci',
                'dana_diusulkan',
                'status',
                'tanggal_pengajuan',
                'periode_skema_id',
                'ketua_dosen_id',
                'bidangpenelitian_id',
                'fakultas_id',
                'prodi_id'
            ]));

            DB::commit();

            return redirect()
                ->route('admin.proposal.index')
                ->with('success', 'Proposal berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Gagal memperbarui proposal: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);

        DB::beginTransaction();

        try {
            // Hapus dokumen dari storage
            foreach ($proposal->dokumen as $dokumen) {
                if (Storage::disk('public')->exists($dokumen->file_path)) {
                    Storage::disk('public')->delete($dokumen->file_path);
                }
            }

            $proposal->delete();

            DB::commit();

            return redirect()
                ->route('admin.proposal.index')
                ->with('success', 'Proposal berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal menghapus proposal: ' . $e->getMessage());
        }
    }

    // =============================================
    // UPDATE STATUS (WORKFLOW)
    // =============================================

    public function updateStatus(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'status' => 'required|in:draft,diajukan,direview,diterima,ditolak,revisi',
        ]);

        $proposal->update(['status' => $request->status]);

        $statusLabels = [
            'draft' => 'Draft',
            'diajukan' => 'Diajukan',
            'direview' => 'Di Review',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            'revisi' => 'Revisi',
        ];

        return redirect()
            ->route('admin.proposal.index')
            ->with('success', 'Status proposal berhasil diubah menjadi ' . ($statusLabels[$request->status] ?? $request->status));
    }

    // =============================================
    // ANGGOTA CRUD (AJAX)
    // =============================================

    public function addAnggota(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required|exists:proposal,id',
            'dosen_id' => 'required|exists:dosen,id',
            'peran' => 'required|in:ketua,anggota',
        ]);

        $anggota = ProposalAnggota::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $anggota->load('dosen')
        ]);
    }

    public function removeAnggota($id)
    {
        $anggota = ProposalAnggota::findOrFail($id);
        $anggota->delete();

        return response()->json(['success' => true]);
    }

    // =============================================
    // MAHASISWA CRUD (AJAX)
    // =============================================

    public function addMahasiswa(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required|exists:proposal,id',
            'nim' => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:255',
            'prodi_mahasiswa' => 'required|string|max:100',
        ]);

        $mahasiswa = ProposalMahasiswa::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $mahasiswa
        ]);
    }

    public function removeMahasiswa($id)
    {
        $mahasiswa = ProposalMahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return response()->json(['success' => true]);
    }

    // =============================================
    // DOKUMEN CRUD (AJAX)
    // =============================================

    public function addDokumen(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required|exists:proposal,id',
            'jenis_dokumen' => 'required|string|max:50',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('proposal/dokumen/' . $request->proposal_id, $fileName, 'public');

        $dokumen = ProposalDokumen::create([
            'proposal_id' => $request->proposal_id,
            'jenis_dokumen' => $request->jenis_dokumen,
            'nama_file' => $file->getClientOriginalName(),
            'file_path' => $filePath,
            'file_size' => $file->getSize(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $dokumen
        ]);
    }

    public function removeDokumen($id)
    {
        $dokumen = ProposalDokumen::findOrFail($id);

        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return response()->json(['success' => true]);
    }

    public function downloadDokumen($id)
    {
        $dokumen = ProposalDokumen::findOrFail($id);

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($dokumen->file_path, $dokumen->nama_file);
    }

    // =============================================
    // REVIEWER CRUD (AJAX)
    // =============================================

    public function addReviewer(Request $request)
    {
        $request->validate([
            'proposal_id' => 'required|exists:proposal,id',
            'reviewer_id' => 'required|exists:reviewer,id',
        ]);

        $reviewer = ProposalReviewer::create([
            'proposal_id' => $request->proposal_id,
            'reviewer_id' => $request->reviewer_id,
            'status_review' => 'pending',
            'tanggal_tugas' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $reviewer->load('reviewer')
        ]);
    }

    public function removeReviewer($id)
    {
        $reviewer = ProposalReviewer::findOrFail($id);
        $reviewer->delete();

        return response()->json(['success' => true]);
    }

    public function updateReviewerStatus(Request $request, $id)
    {
        $reviewer = ProposalReviewer::findOrFail($id);

        $request->validate([
            'status_review' => 'required|in:pending,proses,selesai',
        ]);

        $reviewer->update([
            'status_review' => $request->status_review,
            'tanggal_selesai' => $request->status_review == 'selesai' ? now() : null,
        ]);

        return response()->json(['success' => true]);
    }
}
