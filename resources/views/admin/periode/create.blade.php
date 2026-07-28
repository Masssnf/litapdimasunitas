@extends('layouts.admin')

@section('header', 'Tambah Periode')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- HERO HEADER                                   -->
        <!-- ============================================= -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-emerald-600 via-emerald-500 to-teal-600 rounded-2xl shadow-xl shadow-emerald-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-teal-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-plus-circle text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Periode</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-emerald-100 text-sm">Tambahkan data periode baru</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.periode.index') }}"
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
                <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-emerald-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Form Periode</h3>
                    <p class="text-xs text-gray-400">Lengkapi data periode di bawah ini</p>
                </div>
            </div>

            <form action="{{ route('admin.periode.store') }}" method="POST" class="p-6">
                @csrf

                <!-- BARIS 1: Kode & Nama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="kode_periode" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Kode Periode <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tag text-gray-400"></i>
                            </div>
                            <input type="text" name="kode_periode" id="kode_periode" value="{{ old('kode_periode') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('kode_periode') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: PR-001" required>
                        </div>
                        @error('kode_periode')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_periode" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Periode <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-alt text-gray-400"></i>
                            </div>
                            <input type="text" name="nama_periode" id="nama_periode" value="{{ old('nama_periode') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('nama_periode') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: Periode Penelitian 2024/2025" required>
                        </div>
                        @error('nama_periode')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- BARIS 2: Semester & Tahun Anggaran -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    {{-- <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Semester <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-{{ old('semester') == 'Ganjil' ? 'sun' : 'moon' }} text-gray-400"></i>
                            </div>
                            <select name="semester" id="semester"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('semester') border-rose-500 focus:ring-rose-500 @enderror"
                                required>
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                        </div>
                        @error('semester')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div> --}}
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Semester
                        </label>
                        <select name="semester" id="semester" class="select2 w-full"
                            data-placeholder="Pilih Semester" data-allow-clear="false" data-search="-1" required>
                            <option value="">Pilih Semester</option>
                            <option value="Ganjil" {{ old('semester') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('semester') == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                        @error('semester')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="tahun_anggaran" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tahun Anggaran <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar-check text-gray-400"></i>
                            </div>
                            <input type="text" name="tahun_anggaran" id="tahun_anggaran"
                                value="{{ old('tahun_anggaran') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('tahun_anggaran') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: 2024" required>
                        </div>
                        @error('tahun_anggaran')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- BARIS 3: Status & Keterangan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="status_periode" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select name="status_periode" id="status_periode" class="select2 w-full"
                            data-placeholder="Pilih Status" data-allow-clear="false" data-search="-1" required>
                            <option value="1" {{ old('status_periode') == '1' ? 'selected' : '' }}>✅ Aktif</option>
                            <option value="0" {{ old('status_periode') == '0' ? 'selected' : '' }}>❌ Nonaktif</option>
                        </select>
                        @error('status_periode')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="keterangan_periode" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Keterangan
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-align-left text-gray-400"></i>
                            </div>
                            <input type="text" name="keterangan_periode" id="keterangan_periode"
                                value="{{ old('keterangan_periode') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('keterangan_periode') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: Periode ganjil tahun 2024">
                        </div>
                        @error('keterangan_periode')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-end gap-3">
                    <a href="{{ route('admin.periode.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-xl hover:from-emerald-600 hover:to-teal-600 transition-all duration-200 shadow-md shadow-emerald-500/25 hover:shadow-lg hover:shadow-emerald-500/30 text-sm font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Periode
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk Status
            $('#status_periode').select2({
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

            // Update icon semester saat berubah
            $('#semester').on('change', function() {
                var val = $(this).val();
                var icon = val == 'Ganjil' ? 'fa-sun' : 'fa-moon';
                $(this).siblings('.absolute').find('i').attr('class', 'fas ' + icon + ' text-gray-400');
            });
        });
    </script>
@endsection
