@extends('layouts.admin')

@section('header', 'Tambah Mahasiswa')

@section('content')
    <div class="space-y-5">
        <div
            class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-500 to-purple-600 rounded-2xl shadow-xl shadow-indigo-500/20 p-6">
            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Mahasiswa</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-indigo-100 text-sm">Proposal: {{ $proposal->kode_proposal }}</span>
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
                <h3 class="text-sm font-semibold text-gray-700">Form Tambah Mahasiswa</h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.proposal.mahasiswa.store', $proposal->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">NIM <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="nim" value="{{ old('nim') }}"
                                class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            @error('nim')
                                <p class="text-rose-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="nama_mahasiswa" value="{{ old('nama_mahasiswa') }}"
                                class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            @error('nama_mahasiswa')
                                <p class="text-rose-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Program Studi <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" name="prodi_mahasiswa" value="{{ old('prodi_mahasiswa') }}"
                                class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                                required>
                            @error('prodi_mahasiswa')
                                <p class="text-rose-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <a href="{{ route('admin.proposal.show', $proposal->id) }}"
                            class="px-6 py-2.5 border rounded-xl">Batal</a>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-500 text-white rounded-xl hover:bg-indigo-600">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
