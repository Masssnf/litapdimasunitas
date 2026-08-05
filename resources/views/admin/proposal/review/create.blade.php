@extends('layouts.admin')

@section('header', 'Tambah Hasil Review')

@section('content')
<div class="space-y-5">

    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-600 rounded-2xl shadow-xl shadow-emerald-500/20 p-6">
        <div class="relative flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                    <i class="fas fa-clipboard-check text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Hasil Review</h1>
                    <div class="flex items-center space-x-3 mt-0.5">
                        <span class="text-emerald-100 text-sm">Proposal: {{ $proposal->kode_proposal }}</span>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.proposal.review.index', $proposal->id) }}" 
               class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-sm font-semibold text-gray-700">Form Hasil Review</h3>
            <p class="text-xs text-gray-400">Isi hasil review dari reviewer</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.proposal.review.store', $proposal->id) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Pilih Reviewer <span class="text-rose-500">*</span>
                        </label>
                        <select name="reviewer_id" class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <option value="">Pilih Reviewer</option>
                            @foreach($reviewers as $item)
                                <option value="{{ $item->reviewer_id }}" {{ old('reviewer_id') == $item->reviewer_id ? 'selected' : '' }}>
                                    {{ $item->reviewer->nama_reviewer ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('reviewer_id') <p class="text-rose-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tanggal Review <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" name="tanggal_review" value="{{ old('tanggal_review') }}" 
                               class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                        @error('tanggal_review') <p class="text-rose-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nilai (0-100)
                        </label>
                        <input type="number" name="nilai" value="{{ old('nilai') }}" 
                               class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                               min="0" max="100" placeholder="85">
                        @error('nilai') <p class="text-rose-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Keputusan <span class="text-rose-500">*</span>
                        </label>
                        <select name="rekomendasi" class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500" required>
                            <option value="">Pilih Keputusan</option>
                            <option value="Lolos" {{ old('rekomendasi') == 'Lolos' ? 'selected' : '' }}>✅ Lolos</option>
                            <option value="Revisi" {{ old('rekomendasi') == 'Revisi' ? 'selected' : '' }}>🔄 Revisi</option>
                            <option value="Ditolak" {{ old('rekomendasi') == 'Ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                        </select>
                        @error('rekomendasi') <p class="text-rose-500 text-sm">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Catatan / Komentar
                    </label>
                    <textarea name="catatan" rows="4" class="w-full rounded-xl border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">{{ old('catatan') }}</textarea>
                    @error('catatan') <p class="text-rose-500 text-sm">{{ $message }}</p> @enderror
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.proposal.review.index', $proposal->id) }}" class="px-6 py-2.5 border rounded-xl">Batal</a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600">
                        <i class="fas fa-save mr-2"></i>Simpan Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection