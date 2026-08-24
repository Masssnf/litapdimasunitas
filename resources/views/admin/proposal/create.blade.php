@extends('layouts.admin')

@section('header', 'Tambah Proposal')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- HERO HEADER                                   -->
        <!-- ============================================= -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-500 to-purple-600 rounded-2xl shadow-xl shadow-indigo-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-purple-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-plus-circle text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Proposal</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-indigo-100 text-sm">Tambahkan data proposal baru</span>
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
        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-file-alt text-indigo-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Form Data Proposal</h3>
                    <p class="text-xs text-gray-400">Lengkapi data proposal di bawah ini</p>
                </div>
            </div>

            <form action="{{ route('admin.proposal.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Kode Proposal <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="kode_proposal" value="{{ old('kode_proposal') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('kode_proposal')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Judul <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('judul')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Dana Diusulkan
                        </label>
                        <input type="number" name="dana_diusulkan" value="{{ old('dana_diusulkan') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="10000000" min="0" step="1000">
                        @error('dana_diusulkan')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tanggal Pengajuan <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" name="tanggal_pengajuan" value="{{ old('tanggal_pengajuan') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('tanggal_pengajuan')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select name="status"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Diajukan" {{ old('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="Diverifikasi" {{ old('status') == 'Diverifikasi' ? 'selected' : '' }}>
                                Diverifikasi</option>
                            <option value="Direview" {{ old('status') == 'Direview' ? 'selected' : '' }}>Direview</option>
                            <option value="Revisi" {{ old('status') == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                            <option value="Lolos" {{ old('status') == 'Lolos' ? 'selected' : '' }}>Lolos</option>
                            <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select name="status" id="status" class="select2 w-full" data-placeholder="Pilih Status"
                            data-allow-clear="false" data-search="-1" required>
                            <option value="">Pilih Status</option>
                            <option value="Draft" {{ old('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Diajukan" {{ old('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="Diverifikasi" {{ old('status') == 'Diverifikasi' ? 'selected' : '' }}>
                                Diverifikasi</option>
                            <option value="Direview" {{ old('status') == 'Direview' ? 'selected' : '' }}>Direview</option>
                            <option value="Revisi" {{ old('status') == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                            <option value="Lolos" {{ old('status') == 'Lolos' ? 'selected' : '' }}>Lolos</option>
                            <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="periode_skema_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Periode Skema <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <select name="periode_skema_id" id="periode_skema_id"
                                class="select2 w-full @error('periode_skema_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Periode Skema" required>
                                <option value="">Pilih Periode Skema</option>
                                @foreach ($periodeSkema as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('periode_skema_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->periode->kode_periode }} - {{ $item->skema->nama_skema ?? '' }}
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

                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Ketua Dosen <span class="text-rose-500">*</span>
                        </label>
                        <select name="ketua_dosen_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Ketua Dosen</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('ketua_dosen_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nidn }} - {{ $item->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('ketua_dosen_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div>
                        <label for="ketua_dosen_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Ketua Dosen <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <select name="ketua_dosen_id" id="ketua_dosen_id"
                                class="select2 w-full @error('ketua_dosen_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Ketua Dosen" required>
                                <option value="">Pilih Ketua Dosen</option>
                                @foreach ($dosen as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('ketua_dosen_id') == $item->id ? 'selected' : '' }}>
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

                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Bidang Penelitian <span class="text-rose-500">*</span>
                        </label>
                        <select name="bidangpenelitian_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Bidang Penelitian</option>
                            @foreach ($bidangPenelitian as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('bidangpenelitian_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_bidang }} - {{ $item->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
                        @error('bidangpenelitian_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div>
                        <label for="bidangpenelitian_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Bidang Penelitian <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <select name="bidangpenelitian_id" id="bidangpenelitian_id"
                                class="select2 w-full @error('bidangpenelitian_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Bidang Penelitian" required>
                                <option value="">Pilih Bidang Penelitian</option>
                                @foreach ($bidangPenelitian as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('bidangpenelitian_id') == $item->id ? 'selected' : '' }}>
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

                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Fakultas <span class="text-rose-500">*</span>
                        </label>
                        <select name="fakultas_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('fakultas_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_fakultas }} - {{ $item->nama_fakultas }}
                                </option>
                            @endforeach
                        </select>
                        @error('fakultas_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div>
                        <label for="fakultas_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Fakultas <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <select name="fakultas_id" id="fakultas_id"
                                class="select2 w-full @error('fakultas_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Fakultas" required>
                                <option value="">Pilih Fakultas</option>
                                @foreach ($fakultas as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('fakultas_id') == $item->id ? 'selected' : '' }}>
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

                    {{-- <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Program Studi <span class="text-rose-500">*</span>
                        </label>
                        <select name="prodi_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}" {{ old('prodi_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_prodi }} - {{ $item->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div>
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Prodi <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <select name="prodi_id" id="prodi_id"
                                class="select2 w-full @error('prodi_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Prodi" required>
                                <option value="">Pilih Prodi</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('prodi_id') == $item->id ? 'selected' : '' }}>
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

                <!-- Ringkasan & Kata Kunci -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Ringkasan</label>
                        <textarea name="ringkasan" rows="3"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('ringkasan') }}</textarea>
                        @error('ringkasan')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kata Kunci</label>
                        <input type="text" name="kata_kunci" value="{{ old('kata_kunci') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Pendidikan, Karakter, Sekolah">
                        @error('kata_kunci')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.proposal.index') }}" class="px-6 py-2.5 border rounded-xl">Batal</a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl">
                        <i class="fas fa-save mr-2"></i>Simpan Proposal
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
