@extends('layouts.admin')

@section('header', 'Tambah Reviewer')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- HERO HEADER                                   -->
        <!-- ============================================= -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-teal-600 via-teal-500 to-cyan-600 rounded-2xl shadow-xl shadow-teal-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-cyan-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Reviewer</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-teal-100 text-sm">Tambahkan data reviewer baru</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.reviewer.index') }}"
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
                <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center">
                    <i class="fas fa-user-check text-teal-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Form Data Reviewer</h3>
                    <p class="text-xs text-gray-400">Lengkapi data reviewer di bawah ini</p>
                </div>
            </div>

            <form action="{{ route('admin.reviewer.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <div class="space-y-4">
                        <!-- Kode Reviewer -->
                        <div>
                            <label for="kode_reviewer" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Kode Reviewer <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400"></i>
                                </div>
                                <input type="text" name="kode_reviewer" id="kode_reviewer"
                                    value="{{ old('kode_reviewer') }}"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition @error('kode_reviewer') border-rose-500 focus:ring-rose-500 @enderror"
                                    placeholder="Contoh: RV-001" required>
                            </div>
                            @error('kode_reviewer')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Nama Reviewer -->
                        <div>
                            <label for="nama_reviewer" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Nama Reviewer <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="nama_reviewer" id="nama_reviewer"
                                    value="{{ old('nama_reviewer') }}"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition @error('nama_reviewer') border-rose-500 focus:ring-rose-500 @enderror"
                                    placeholder="Contoh: Dr. Ahmad Fauzi, M.Pd" required>
                            </div>
                            @error('nama_reviewer')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- NIDN -->
                        <div>
                            <label for="nidn_reviewer" class="block text-sm font-medium text-gray-700 mb-1.5">
                                NIDN
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-id-card text-gray-400"></i>
                                </div>
                                <input type="text" name="nidn_reviewer" id="nidn_reviewer"
                                    value="{{ old('nidn_reviewer') }}"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition @error('nidn_reviewer') border-rose-500 focus:ring-rose-500 @enderror"
                                    placeholder="Contoh: 1234567890">
                            </div>
                            @error('nidn_reviewer')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Instansi -->
                        <div>
                            <label for="instansi_reviewer" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Instansi
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-building text-gray-400"></i>
                                </div>
                                <input type="text" name="instansi_reviewer" id="instansi_reviewer"
                                    value="{{ old('instansi_reviewer') }}"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition @error('instansi_reviewer') border-rose-500 focus:ring-rose-500 @enderror"
                                    placeholder="Contoh: Universitas Islam Tasikmalaya">
                            </div>
                            @error('instansi_reviewer')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Email -->
                        <div>
                            <label for="email_reviewer" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email_reviewer" id="email_reviewer"
                                    value="{{ old('email_reviewer') }}"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition @error('email_reviewer') border-rose-500 focus:ring-rose-500 @enderror"
                                    placeholder="Contoh: ahmad@unita.ac.id">
                            </div>
                            @error('email_reviewer')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label for="notelp_reviewer" class="block text-sm font-medium text-gray-700 mb-1.5">
                                No Telepon
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-phone text-gray-400"></i>
                                </div>
                                <input type="text" name="notelp_reviewer" id="notelp_reviewer"
                                    value="{{ old('notelp_reviewer') }}"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition @error('notelp_reviewer') border-rose-500 focus:ring-rose-500 @enderror"
                                    placeholder="Contoh: 081234567890">
                            </div>
                            @error('notelp_reviewer')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Jenis Reviewer -->
                        <div>
                            <label for="jenisreviewer_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Jenis Reviewer <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tags text-gray-400"></i>
                                </div>
                                <select name="jenisreviewer_id" id="jenisreviewer_id"
                                    class="select2 w-full @error('jenisreviewer_id') border-rose-500 focus:ring-rose-500 @enderror"
                                    data-placeholder="Pilih Jenis Reviewer" required>
                                    <option value="">Pilih Jenis Reviewer</option>
                                    @foreach ($jenisReviewer as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('jenisreviewer_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->kode_jenisreviewer }} - {{ $item->nama_jenisreviewer }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jenisreviewer_id')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Dosen (Opsional) -->
                        <div>
                            <label for="dosen_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Dosen (Opsional)
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chalkboard-teacher text-gray-400"></i>
                                </div>
                                <select name="dosen_id" id="dosen_id"
                                    class="select2 w-full @error('dosen_id') border-rose-500 focus:ring-rose-500 @enderror"
                                    data-placeholder="Pilih Dosen (Opsional)">
                                    <option value="">Pilih Dosen (Opsional)</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('dosen_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nidn }} - {{ $item->nama_dosen }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('dosen_id')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status_reviewer" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Status <span class="text-rose-500">*</span>
                            </label>
                            <select name="status_reviewer" id="status_reviewer" class="select2 w-full"
                                data-placeholder="Pilih Status" data-allow-clear="false" data-search="-1" required>
                                <option value="1" {{ old('status_reviewer') == '1' ? 'selected' : '' }}>✅ Aktif
                                </option>
                                <option value="0" {{ old('status_reviewer') == '0' ? 'selected' : '' }}>❌ Nonaktif
                                </option>
                            </select>
                            @error('status_reviewer')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-end gap-3">
                    <a href="{{ route('admin.reviewer.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-teal-500 to-cyan-500 text-white rounded-xl hover:from-teal-600 hover:to-cyan-600 transition-all duration-200 shadow-md shadow-teal-500/25 hover:shadow-lg hover:shadow-teal-500/30 text-sm font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Reviewer
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#status_reviewer').select2({
                placeholder: 'Pilih Status',
                allowClear: false,
                minimumResultsForSearch: -1,
                width: '100%',
                templateResult: formatStatus,
                templateSelection: formatStatusSelection
            });

            function formatStatus(state) {
                if (!state.id) return state.text;
                var isActive = state.id == 1;
                var dotColor = isActive ? 'bg-emerald-500' : 'bg-rose-500';
                var textColor = isActive ? 'text-emerald-600' : 'text-rose-600';
                return $('<span class="flex items-center gap-2">' +
                    '<span class="w-2 h-2 rounded-full ' + dotColor + '"></span>' +
                    '<span class="' + textColor + ' font-medium">' + state.text + '</span>' +
                    '</span>');
            }

            function formatStatusSelection(state) {
                if (!state.id) return state.text;
                var isActive = state.id == 1;
                var dotColor = isActive ? 'bg-emerald-500' : 'bg-rose-500';
                var textColor = isActive ? 'text-emerald-600' : 'text-rose-600';
                return $('<span class="flex items-center gap-2">' +
                    '<span class="w-2 h-2 rounded-full ' + dotColor + '"></span>' +
                    '<span class="' + textColor + ' font-medium">' + state.text + '</span>' +
                    '</span>');
            }
        });
    </script>
@endsection
