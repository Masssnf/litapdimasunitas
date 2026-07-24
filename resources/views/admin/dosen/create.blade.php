@extends('layouts.admin')

@section('header', 'Tambah Dosen')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- HERO HEADER                                   -->
        <!-- ============================================= -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-600 rounded-2xl shadow-xl shadow-blue-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-cyan-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Dosen</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-blue-100 text-sm">Tambahkan data dosen baru</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.dosen.index') }}"
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
                <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Form Data Dosen</h3>
                    <p class="text-xs text-gray-400">Lengkapi data dosen di bawah ini</p>
                </div>
            </div>

            <form action="{{ route('admin.dosen.store') }}" method="POST" class="p-6">
                @csrf

                <!-- BARIS 1: NIDN & Nama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nidn" class="block text-sm font-medium text-gray-700 mb-1.5">
                            NIDN <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-id-card text-gray-400"></i>
                            </div>
                            <input type="text" name="nidn" id="nidn" value="{{ old('nidn') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nidn') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: 1234567890" required>
                        </div>
                        @error('nidn')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_dosen" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Dosen <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="nama_dosen" id="nama_dosen" value="{{ old('nama_dosen') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('nama_dosen') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: Dr. Ahmad Fauzi, M.Pd" required>
                        </div>
                        @error('nama_dosen')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- BARIS 2: Jenis Kelamin & Email -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Jenis Kelamin
                        </label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="select2 w-full"
                            data-placeholder="Pilih Jenis Kelamin" data-allow-clear="false" data-search="-1" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email_dosen" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email_dosen" id="email_dosen" value="{{ old('email_dosen') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('email_dosen') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: ahmad@unita.ac.id">
                        </div>
                        @error('email_dosen')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- BARIS 3: No Telepon & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="notelp_dosen" class="block text-sm font-medium text-gray-700 mb-1.5">
                            No Telepon
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input type="text" name="notelp_dosen" id="notelp_dosen" value="{{ old('notelp_dosen') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('notelp_dosen') border-rose-500 focus:ring-rose-500 @enderror"
                                placeholder="Contoh: 081234567890">
                        </div>
                        @error('notelp_dosen')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_dosen" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select name="status_dosen" id="status_dosen" class="select2 w-full" data-placeholder="Pilih Status"
                            data-allow-clear="false" data-search="-1" required>
                            <option value="">Pilih Status</option>
                            <option value="1" {{ old('status_dosen') == '1' ? 'selected' : '' }}>✅ Aktif</option>
                            <option value="0" {{ old('status_dosen') == '0' ? 'selected' : '' }}>❌ Nonaktif</option>
                        </select>
                        @error('status_dosen')
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

                    <div>
                        <label for="prodi_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Program Studi <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-book-open text-gray-400"></i>
                            </div>
                            <select name="prodi_id" id="prodi_id"
                                class="select2 w-full @error('prodi_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Program Studi" required>
                                <option value="">Pilih Program Studi</option>
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

                <!-- BARIS 5: Alamat (Full Width) -->
                <div class="mt-4">
                    <label for="alamat_dosen" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Alamat
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                        </div>
                        <textarea name="alamat_dosen" id="alamat_dosen" rows="3"
                            class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('alamat_dosen') border-rose-500 focus:ring-rose-500 @enderror"
                            placeholder="Masukkan alamat lengkap dosen">{{ old('alamat_dosen') }}</textarea>
                    </div>
                    @error('alamat_dosen')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-end gap-3">
                    <a href="{{ route('admin.dosen.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-xl hover:from-blue-600 hover:to-cyan-600 transition-all duration-200 shadow-md shadow-blue-500/25 hover:shadow-lg hover:shadow-blue-500/30 text-sm font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Dosen
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
            $('#status_dosen').select2({
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
