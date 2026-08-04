@extends('layouts.admin')

@section('header', 'Edit Proposal')

@section('content')
<div class="space-y-5">

    <!-- ============================================= -->
    <!-- HERO HEADER                                   -->
    <!-- ============================================= -->
    <div class="relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 rounded-2xl shadow-xl shadow-amber-500/20 p-6">
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-orange-400/10 rounded-full blur-3xl"></div>

        <div class="relative flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                    <i class="fas fa-edit text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Edit Proposal</h1>
                    <div class="flex items-center space-x-3 mt-0.5">
                        <span class="text-amber-100 text-sm">Ubah informasi data proposal</span>
                        <span class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                            {{ $proposal->kode_proposal }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.proposal.index') }}"
                class="group relative px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- ============================================= -->
    <!-- FORM                                         -->
    <!-- ============================================= -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center">
                <i class="fas fa-file-alt text-amber-600"></i>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700">Form Edit Proposal</h3>
                <p class="text-xs text-gray-400">Ubah data proposal di bawah ini</p>
            </div>
        </div>

        <form action="{{ route('admin.proposal.update', $proposal->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- BARIS 1: Kode Proposal & Judul -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="kode_proposal" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kode Proposal <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="kode_proposal" 
                               id="kode_proposal"
                               value="{{ old('kode_proposal', $proposal->kode_proposal) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('kode_proposal') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: PR-2024-001" 
                               required>
                    </div>
                    @error('kode_proposal')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Judul <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-heading text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="judul" 
                               id="judul"
                               value="{{ old('judul', $proposal->judul) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('judul') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Masukkan judul proposal" 
                               required>
                    </div>
                    @error('judul')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 2: Periode Skema & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="periode_skema_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Periode Skema <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-check text-gray-400"></i>
                        </div>
                        <select name="periode_skema_id" 
                                id="periode_skema_id"
                                class="select2 w-full @error('periode_skema_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Periode Skema"
                                required>
                            <option value="">Pilih Periode Skema</option>
                            @foreach($periodeSkema as $item)
                                <option value="{{ $item->id }}" {{ old('periode_skema_id', $proposal->periode_skema_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->periode->kode_periode ?? '' }} - {{ $item->skema->nama_skema ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('periode_skema_id')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-info-circle text-gray-400"></i>
                        </div>
                        <select name="status" 
                                id="status"
                                class="select2 w-full @error('status') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Status"
                                required>
                            <option value="">Pilih Status</option>
                            <option value="draft" {{ old('status', $proposal->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="diajukan" {{ old('status', $proposal->status) == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="direview" {{ old('status', $proposal->status) == 'direview' ? 'selected' : '' }}>Di Review</option>
                            <option value="diterima" {{ old('status', $proposal->status) == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ old('status', $proposal->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="revisi" {{ old('status', $proposal->status) == 'revisi' ? 'selected' : '' }}>Revisi</option>
                        </select>
                    </div>
                    @error('status')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 3: Ketua Dosen & Dana Diusulkan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="ketua_dosen_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Ketua Dosen <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tie text-gray-400"></i>
                        </div>
                        <select name="ketua_dosen_id" 
                                id="ketua_dosen_id"
                                class="select2 w-full @error('ketua_dosen_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Ketua Dosen"
                                required>
                            <option value="">Pilih Ketua Dosen</option>
                            @foreach($dosen as $item)
                                <option value="{{ $item->id }}" {{ old('ketua_dosen_id', $proposal->ketua_dosen_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nidn }} - {{ $item->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('ketua_dosen_id')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="dana_diusulkan" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Dana Diusulkan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-money-bill-wave text-gray-400"></i>
                        </div>
                        <input type="number" 
                               name="dana_diusulkan" 
                               id="dana_diusulkan"
                               value="{{ old('dana_diusulkan', $proposal->dana_diusulkan) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('dana_diusulkan') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: 10000000"
                               min="0"
                               step="1000">
                    </div>
                    @error('dana_diusulkan')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 4: Fakultas & Prodi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="fakultas_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Fakultas <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-university text-gray-400"></i>
                        </div>
                        <select name="fakultas_id" 
                                id="fakultas_id"
                                class="select2 w-full @error('fakultas_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Fakultas"
                                required>
                            <option value="">Pilih Fakultas</option>
                            @foreach($fakultas as $item)
                                <option value="{{ $item->id }}" {{ old('fakultas_id', $proposal->fakultas_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_fakultas }} - {{ $item->nama_fakultas }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('fakultas_id')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="prodi_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Program Studi <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-book-open text-gray-400"></i>
                        </div>
                        <select name="prodi_id" 
                                id="prodi_id"
                                class="select2 w-full @error('prodi_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Program Studi"
                                required>
                            <option value="">Pilih Program Studi</option>
                            @foreach($prodi as $item)
                                <option value="{{ $item->id }}" {{ old('prodi_id', $proposal->prodi_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_prodi }} - {{ $item->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('prodi_id')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 5: Bidang Penelitian & Tanggal Pengajuan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="bidangpenelitian_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Bidang Penelitian <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-flask text-gray-400"></i>
                        </div>
                        <select name="bidangpenelitian_id" 
                                id="bidangpenelitian_id"
                                class="select2 w-full @error('bidangpenelitian_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Bidang Penelitian"
                                required>
                            <option value="">Pilih Bidang Penelitian</option>
                            @foreach($bidangPenelitian as $item)
                                <option value="{{ $item->id }}" {{ old('bidangpenelitian_id', $proposal->bidangpenelitian_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_bidang }} - {{ $item->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('bidangpenelitian_id')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_pengajuan" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tanggal Pengajuan <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                        </div>
                        <input type="date" 
                               name="tanggal_pengajuan" 
                               id="tanggal_pengajuan"
                               value="{{ old('tanggal_pengajuan', $proposal->tanggal_pengajuan ? $proposal->tanggal_pengajuan->format('Y-m-d') : '') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('tanggal_pengajuan') border-rose-500 focus:ring-rose-500 @enderror"
                               required>
                    </div>
                    @error('tanggal_pengajuan')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 6: Ringkasan & Kata Kunci -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="ringkasan" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Ringkasan
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <i class="fas fa-align-left text-gray-400"></i>
                        </div>
                        <textarea name="ringkasan" 
                                  id="ringkasan" 
                                  rows="3"
                                  class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('ringkasan') border-rose-500 focus:ring-rose-500 @enderror"
                                  placeholder="Masukkan ringkasan proposal">{{ old('ringkasan', $proposal->ringkasan) }}</textarea>
                    </div>
                    @error('ringkasan')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="kata_kunci" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kata Kunci
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tags text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="kata_kunci" 
                               id="kata_kunci"
                               value="{{ old('kata_kunci', $proposal->kata_kunci) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('kata_kunci') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: Pendidikan, Karakter, Sekolah">
                    </div>
                    @error('kata_kunci')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-end gap-3">
                <a href="{{ route('admin.proposal.index') }}" 
                   class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 shadow-md shadow-amber-500/25 hover:shadow-lg hover:shadow-amber-500/30 text-sm font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Update Proposal
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2({
            width: '100%'
        });
    });
</script>
@endsection