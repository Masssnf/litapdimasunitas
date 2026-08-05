<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Proposal;
use App\Models\ProposalAnggota;
use Illuminate\Http\Request;

class ProposalAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($proposal_id)
    {
        $proposal = Proposal::with('anggota.dosen')->findOrFail($proposal_id);
        return view('admin.proposal.anggota.index', compact('proposal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);

        $existingDosen = ProposalAnggota::where('proposal_id', $proposal_id)
            ->pluck('dosen_id')
            ->toArray();

        $dosen = Dosen::where('status_dosen', true)
            ->whereNotIn('id', $existingDosen)
            ->get();

        return view('admin.proposal.anggota.create', compact('proposal', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $proposal_id)
    {
        // ✅ Tambahkan validasi unique untuk mencegah duplikasi dosen dalam satu proposal
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id|unique:proposal_anggota,dosen_id,NULL,id,proposal_id,' . $proposal_id,
            'peran' => 'required|in:ketua,anggota',
        ]);

        ProposalAnggota::create([
            'proposal_id' => $proposal_id,
            'dosen_id' => $request->dosen_id,
            'peran' => $request->peran,
        ]);

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Anggota berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($proposal_id, $id)
    {
        // ✅ Implementasi edit anggota
        $proposal = Proposal::findOrFail($proposal_id);
        $anggota = ProposalAnggota::with('dosen')->findOrFail($id);

        return view('admin.proposal.anggota.edit', compact('proposal', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $proposal_id, $id)
    {
        // ✅ Implementasi update anggota
        $anggota = ProposalAnggota::findOrFail($id);

        $request->validate([
            'peran' => 'required|in:ketua,anggota',
        ]);

        $anggota->update([
            'peran' => $request->peran,
        ]);

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Anggota berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($proposal_id, $id)
    {
        $anggota = ProposalAnggota::findOrFail($id);
        $anggota->delete();

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Anggota berhasil dihapus!');
    }
}
