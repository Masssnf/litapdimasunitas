<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalMahasiswa;
use Illuminate\Http\Request;

class ProposalMahasiswaController extends Controller
{
    public function index($proposal_id)
    {
        $proposal = Proposal::with('mahasiswa')->findOrFail($proposal_id);
        return view('admin.proposal.mahasiswa.index', compact('proposal'));
    }

    public function create($proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);
        return view('admin.proposal.mahasiswa.create', compact('proposal'));
    }

    public function store(Request $request, $proposal_id)
    {
        $request->validate([
            'nim' => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:255',
            'prodi_mahasiswa' => 'required|string|max:100',
        ]);

        ProposalMahasiswa::create([
            'proposal_id' => $proposal_id,
            'nim' => $request->nim,
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'prodi_mahasiswa' => $request->prodi_mahasiswa,
        ]);

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Mahasiswa berhasil ditambahkan!');
    }

    public function edit($proposal_id, $id)
    {
        $proposal = Proposal::findOrFail($proposal_id);
        $mahasiswa = ProposalMahasiswa::findOrFail($id);
        return view('admin.proposal.mahasiswa.edit', compact('proposal', 'mahasiswa'));
    }

    public function update(Request $request, $proposal_id, $id)
    {
        $mahasiswa = ProposalMahasiswa::findOrFail($id);

        $request->validate([
            'nim' => 'required|string|max:20',
            'nama_mahasiswa' => 'required|string|max:255',
            'prodi_mahasiswa' => 'required|string|max:100',
        ]);

        $mahasiswa->update($request->all());

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    public function destroy($proposal_id, $id)
    {
        $mahasiswa = ProposalMahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Mahasiswa berhasil dihapus!');
    }
}
