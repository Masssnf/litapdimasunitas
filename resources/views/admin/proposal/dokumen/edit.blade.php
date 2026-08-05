@extends('layouts.admin')

@section('header', 'Edit Dokumen')

@section('content')
    <div class="space-y-5">
        <div
            class="relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 rounded-2xl shadow-xl shadow-amber-500/20 p-6">
            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-file-edit text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Edit Dokumen</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-amber-100 text-sm">Proposal: {{ $proposal->kode_proposal }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.proposal.show', $proposal->id) }}"
                    class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-sm font-semibold text-gray-700">Form Edit Dokumen</h3>
                <p class="text-xs text-gray-400">File: {{ $dokumen->nama_file_asli }}</p>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.proposal.dokumen.update', [$proposal->id, $dokumen->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Jenis Dokumen <span class="text-rose-500">*</span>
                            </label>
                            <select name="jenis_dokumen"
                                class="w-full rounded-xl border-gray-300 focus:ring-amber-500 focus:border-amber-500"
                                required>
                                <option value="Proposal"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'Proposal' ? 'selected' : '' }}>
                                    Proposal</option>
                                <option value="RAB"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'RAB' ? 'selected' : '' }}>RAB
                                </option>
                                <option value="CV Ketua"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'CV Ketua' ? 'selected' : '' }}>CV
                                    Ketua</option>
                                <option value="CV Anggota"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'CV Anggota' ? 'selected' : '' }}>CV
                                    Anggota</option>
                                <option value="Surat Pernyataan"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'Surat Pernyataan' ? 'selected' : '' }}>
                                    Surat Pernyataan</option>
                                <option value="Surat Tugas"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'Surat Tugas' ? 'selected' : '' }}>
                                    Surat Tugas</option>
                                <option value="Luaran"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'Luaran' ? 'selected' : '' }}>
                                    Luaran</option>
                                <option value="Lampiran"
                                    {{ old('jenis_dokumen', $dokumen->jenis_dokumen) == 'Lampiran' ? 'selected' : '' }}>
                                    Lampiran</option>
                            </select>
                            @error('jenis_dokumen')
                                <p class="text-rose-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Status Verifikasi
                            </label>
                            <select name="status_verifikasi"
                                class="w-full rounded-xl border-gray-300 focus:ring-amber-500 focus:border-amber-500">
                                <option value="Menunggu"
                                    {{ old('status_verifikasi', $dokumen->status_verifikasi) == 'Menunggu' ? 'selected' : '' }}>
                                    Menunggu</option>
                                <option value="Valid"
                                    {{ old('status_verifikasi', $dokumen->status_verifikasi) == 'Valid' ? 'selected' : '' }}>
                                    Valid</option>
                                <option value="Revisi"
                                    {{ old('status_verifikasi', $dokumen->status_verifikasi) == 'Revisi' ? 'selected' : '' }}>
                                    Revisi</option>
                            </select>
                            @error('status_verifikasi')
                                <p class="text-rose-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan</label>
                        <textarea name="catatan" rows="2"
                            class="w-full rounded-xl border-gray-300 focus:ring-amber-500 focus:border-amber-500">{{ old('catatan', $dokumen->catatan) }}</textarea>
                        @error('catatan')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.proposal.show', $proposal->id) }}"
                            class="px-6 py-2.5 border rounded-xl">Batal</a>
                        <button type="submit" class="px-6 py-2.5 bg-amber-500 text-white rounded-xl hover:bg-amber-600">
                            <i class="fas fa-save mr-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
