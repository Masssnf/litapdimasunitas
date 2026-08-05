<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\ProposalDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProposalDokumenController extends Controller
{
    public function index($proposal_id)
    {
        $proposal = Proposal::with('dokumen')->findOrFail($proposal_id);
        return view('admin.proposal.dokumen.index', compact('proposal'));
    }

    public function create($proposal_id)
    {
        $proposal = Proposal::findOrFail($proposal_id);
        return view('admin.proposal.dokumen.create', compact('proposal'));
    }

    public function store(Request $request, $proposal_id)
    {
        $request->validate([
            'jenis_dokumen' => 'required|string|max:50',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();
        $size = $file->getSize();

        // Nama file unik di storage
        $fileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;
        $filePath = $file->storeAs('proposal/dokumen/' . $proposal_id, $fileName, 'public');

        // ✅ Simpan semua field sesuai migration
        ProposalDokumen::create([
            'proposal_id' => $proposal_id,
            'jenis_dokumen' => $request->jenis_dokumen,
            'versi' => 1, // Default versi pertama
            'is_latest' => true, // Dokumen terbaru
            'nama_file' => $fileName, // Nama file di storage
            'nama_file_asli' => $originalName, // Nama asli dari user
            'file_path' => $filePath,
            'mime_type' => $mimeType,
            'ekstensi' => $extension,
            'ukuran_file' => $size, // ✅ Sesuai dengan migration
            'status_verifikasi' => 'Menunggu', // Default status
            'catatan' => null,
            'uploaded_by' => auth()->id(), // User yang sedang login
        ]);

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Dokumen berhasil diupload!');
    }

    public function update(Request $request, $proposal_id, $id)
    {
        $dokumen = ProposalDokumen::findOrFail($id);

        $request->validate([
            'jenis_dokumen' => 'required|string|max:50',
            'status_verifikasi' => 'required|in:Menunggu,Valid,Revisi',
            'catatan' => 'nullable|string',
        ]);

        $dokumen->update([
            'jenis_dokumen' => $request->jenis_dokumen,
            'status_verifikasi' => $request->status_verifikasi,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function destroy($proposal_id, $id)
    {
        $dokumen = ProposalDokumen::findOrFail($id);

        if (Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()
            ->route('admin.proposal.show', $proposal_id)
            ->with('success', 'Dokumen berhasil dihapus!');
    }

    public function download($proposal_id, $id)
    {
        $dokumen = ProposalDokumen::findOrFail($id);

        if (!Storage::disk('public')->exists($dokumen->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        // ✅ Download dengan nama file asli
        return Storage::disk('public')->download($dokumen->file_path, $dokumen->nama_file_asli);
    }
}
