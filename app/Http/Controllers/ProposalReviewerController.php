<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalReviewer;
use App\Models\Reviewer;
use Illuminate\Http\Request;

class ProposalReviewerController extends Controller
{
    public function index($proposal_id)
    {
        $proposal = Proposal::with('reviewer.reviewer')->findOrFail($proposal_id);
        return view('admin.proposal.reviewer.index', compact('proposal'));
    }

    public function create($proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);

        $existingReviewer = ProposalReviewer::where('proposal_id', $proposal_id)
            ->pluck('reviewer_id')
            ->toArray();

        $reviewer = Reviewer::where('status_reviewer', true)
            ->whereNotIn('id', $existingReviewer)
            ->get();

        return view('admin.proposal.reviewer.create', compact('proposal', 'reviewer'));
    }

    public function store(Request $request, $proposal_id)
    {
        // ✅ Validasi dengan field yang benar
        $request->validate([
            'reviewer_id' => 'required|exists:reviewer,id|unique:proposal_reviewer,reviewer_id,NULL,id,proposal_id,' . $proposal_id,
        ]);

        // ✅ Hitung urutan berdasarkan jumlah reviewer yang sudah ada
        $urutan = ProposalReviewer::where('proposal_id', $proposal_id)->count() + 1;

        // ✅ Simpan dengan field yang sesuai migration
        ProposalReviewer::create([
            'proposal_id' => $proposal_id,
            'reviewer_id' => $request->reviewer_id,
            'urutan' => $urutan,
            'status_penugasan' => 'Ditugaskan', // ✅ Sesuai migration
            'tanggal_penugasan' => now()->toDateString(), // ✅ Sesuai migration
            'catatan' => $request->catatan ?? null,
        ]);

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Reviewer berhasil ditugaskan!');
    }

    public function edit($proposal_id, $id)
    {
        // ✅ Tambahkan method edit
        $proposal = Proposal::findOrFail($proposal_id);
        $reviewerTugas = ProposalReviewer::with('reviewer')->findOrFail($id);

        return view('admin.proposal.reviewer.edit', compact('proposal', 'reviewerTugas'));
    }

    public function update(Request $request, $proposal_id, $id)
    {
        // ✅ Tambahkan method update
        $reviewerTugas = ProposalReviewer::findOrFail($id);

        $request->validate([
            'status_penugasan' => 'required|in:Ditugaskan,Diterima,Ditolak,Selesai',
            'catatan' => 'nullable|string',
        ]);

        $reviewerTugas->update([
            'status_penugasan' => $request->status_penugasan,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Status reviewer berhasil diperbarui!');
    }

    public function destroy($proposal_id, $id)
    {
        $reviewerTugas = ProposalReviewer::findOrFail($id);
        $reviewerTugas->delete();

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Reviewer berhasil dihapus dari penugasan!');
    }
}
