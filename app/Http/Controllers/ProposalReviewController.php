<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Review;
use App\Models\ProposalReview;
use App\Models\ProposalReviewer;
use Illuminate\Http\Request;

class ProposalReviewController extends Controller
{
    /**
     * Menampilkan history hasil review
     * Menampilkan Review (hasil terakhir) dan ProposalReview (history)
     */
    public function index($proposal_id)
    {
        $proposal = Proposal::with([
            'reviewer',
            'reviewHistory.reviewer',
            'proposalReviewHistory.reviewer'
        ])->findOrFail($proposal_id);

        return view('admin.proposal.review.index', compact('proposal'));
    }

    /**
     * Menampilkan form untuk menambahkan hasil review
     */
    public function create($proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);

        // Cek apakah sudah ada review di tabel Review
        $existingReview = Review::whereHas('proposalReviewer', function ($q) use ($proposal_id) {
            $q->where('proposal_id', $proposal_id);
        })->exists();

        if ($existingReview) {
            return redirect()
                ->route('admin.proposal.review.index', $proposal_id)
                ->with('warning', 'Proposal ini sudah memiliki review.');
        }

        // Cek reviewer yang ditugaskan
        $reviewers = ProposalReviewer::with('reviewer')
            ->where('proposal_id', $proposal_id)
            ->whereIn('status_penugasan', ['Ditugaskan', 'Diterima'])
            ->get();

        if ($reviewers->isEmpty()) {
            return redirect()
                ->route('admin.proposal.review.index', $proposal_id)
                ->with('warning', 'Belum ada reviewer yang ditugaskan.');
        }

        return view('admin.proposal.review.create', compact('proposal', 'reviewers'));
    }

    /**
     * Menyimpan hasil review ke Review dan ProposalReview (history)
     */
    public function store(Request $request, $proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);

        $request->validate([
            'reviewer_id' => 'required|exists:reviewer,id',
            'nilai' => 'nullable|integer|min:0|max:100',
            'catatan' => 'nullable|string',
            'rekomendasi' => 'required|in:Lolos,Revisi,Ditolak',
            'tanggal_review' => 'required|date',
        ]);

        // Cari proposal_reviewer_id
        $proposalReviewer = ProposalReviewer::where('proposal_id', $proposal_id)
            ->where('reviewer_id', $request->reviewer_id)
            ->first();

        if (!$proposalReviewer) {
            return back()->with('error', 'Reviewer tidak ditemukan dalam penugasan.')->withInput();
        }

        // Cek duplikasi
        $existing = Review::where('proposal_reviewer_id', $proposalReviewer->id)->exists();

        if ($existing) {
            return back()->with('error', 'Reviewer ini sudah memberikan review.')->withInput();
        }

        // ✅ 1. SIMPAN KE REVIEW (Hasil terakhir)
        $review = Review::create([
            'proposal_reviewer_id' => $proposalReviewer->id,
            'nilai' => $request->nilai,
            'rekomendasi' => $request->rekomendasi,
            'catatan' => $request->catatan,
            'tanggal_review' => $request->tanggal_review,
        ]);

        // ✅ 2. SIMPAN KE PROPOSALREVIEW (History/Arsip)
        // Map rekomendasi dari Lolos/Revisi/Ditolak ke diterima/ditolak/revisi
        $historyRekomendasi = [
            'Lolos' => 'diterima',
            'Revisi' => 'revisi',
            'Ditolak' => 'ditolak',
        ];

        ProposalReview::create([
            'proposal_reviewer_id' => $proposalReviewer->id,
            'nilai' => $request->nilai,
            'rekomendasi' => $historyRekomendasi[$request->rekomendasi],
            'catatan' => $request->catatan,
            'tanggal_review' => $request->tanggal_review,
        ]);

        // ✅ 3. UPDATE STATUS PROPOSAL
        $statusMap = [
            'Lolos' => 'Lolos',
            'Revisi' => 'Revisi',
            'Ditolak' => 'Ditolak',
        ];
        $proposal->update(['status' => $statusMap[$request->rekomendasi]]);

        // ✅ 4. UPDATE STATUS REVIEWER
        $proposalReviewer->update(['status_penugasan' => 'Selesai']);

        return redirect()
            ->route('admin.proposal.review.index', $proposal_id)
            ->with('success', 'Review berhasil disimpan! Status proposal: ' . $request->rekomendasi);
    }

    /**
     * Menampilkan detail review dari tabel Review
     */
    public function show($proposal_id, $id)
    {
        $proposal = Proposal::findOrFail($proposal_id);
        $review = Review::with('proposalReviewer.reviewer')->findOrFail($id);

        return view('admin.proposal.review.show', compact('proposal', 'review'));
    }

    /**
     * Menghapus review (dari Review dan ProposalReview)
     */
    public function destroy($proposal_id, $id)
    {
        $review = Review::findOrFail($id);

        // ✅ Hapus dari ProposalReview (history)
        ProposalReview::where('proposal_reviewer_id', $review->proposal_reviewer_id)->delete();

        $proposal = Proposal::findOrFail($proposal_id);
        $proposal->update(['status' => 'Direview']);

        $proposalReviewer = ProposalReviewer::find($review->proposal_reviewer_id);
        if ($proposalReviewer) {
            $proposalReviewer->update(['status_penugasan' => 'Ditugaskan']);
        }

        // ✅ Hapus dari Review
        $review->delete();

        return redirect()
            ->route('admin.proposal.review.index', $proposal_id)
            ->with('success', 'Review berhasil dihapus!');
    }
}
