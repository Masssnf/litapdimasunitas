@extends('layouts.admin')

@section('header', 'Edit Program Studi')

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
                    <h1 class="text-2xl font-bold text-white tracking-tight">Edit Program Studi</h1>
                    <div class="flex items-center space-x-3 mt-0.5">
                        <span class="text-amber-100 text-sm">Ubah informasi data program studi</span>
                        <span class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                            {{ $prodi->kode_prodi }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.prodi.index') }}"
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

        <!-- Form Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
            <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center">
                <i class="fas fa-book-open text-amber-600"></i>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700">Form Edit Program Studi</h3>
                <p class="text-xs text-gray-400">Ubah data program studi di bawah ini</p>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('admin.prodi.update', $prodi->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- BARIS 1: Kode & Nama Prodi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Kode Prodi -->
                <div>
                    <label for="kode_prodi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kode Prodi <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="kode_prodi" 
                               id="kode_prodi"
                               value="{{ old('kode_prodi', $prodi->kode_prodi) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('kode_prodi') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: P-01" 
                               required>
                    </div>
                    @error('kode_prodi')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Nama Prodi -->
                <div>
                    <label for="nama_prodi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Prodi <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-book-open text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="nama_prodi" 
                               id="nama_prodi"
                               value="{{ old('nama_prodi', $prodi->nama_prodi) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('nama_prodi') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: Pendidikan Matematika" 
                               required>
                    </div>
                    @error('nama_prodi')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 2: Jenjang & Fakultas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <!-- Jenjang -->
                <div>
                    <label for="jenjang_prodi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Jenjang <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-graduation-cap text-gray-400"></i>
                        </div>
                        <select name="jenjang_prodi" 
                                id="jenjang_prodi"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('jenjang_prodi') border-rose-500 focus:ring-rose-500 @enderror"
                                required>
                            <option value="">Pilih Jenjang</option>
                            <option value="D3" {{ old('jenjang_prodi', $prodi->jenjang_prodi) == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="D4" {{ old('jenjang_prodi', $prodi->jenjang_prodi) == 'D4' ? 'selected' : '' }}>D4</option>
                            <option value="S1" {{ old('jenjang_prodi', $prodi->jenjang_prodi) == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('jenjang_prodi', $prodi->jenjang_prodi) == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ old('jenjang_prodi', $prodi->jenjang_prodi) == 'S3' ? 'selected' : '' }}>S3</option>
                            <option value="Profesi" {{ old('jenjang_prodi', $prodi->jenjang_prodi) == 'Profesi' ? 'selected' : '' }}>Profesi</option>
                        </select>
                    </div>
                    @error('jenjang_prodi')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Fakultas -->
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
                                <option value="{{ $item->id }}" {{ old('fakultas_id', $prodi->fakultas_id) == $item->id ? 'selected' : '' }}>
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
            </div>

            <!-- BARIS 3: Kaprodi & Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <!-- Kaprodi -->
                <div>
                    <label for="kaprodi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kaprodi
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tie text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="kaprodi" 
                               id="kaprodi"
                               value="{{ old('kaprodi', $prodi->kaprodi) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('kaprodi') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: Dr. Ahmad Fauzi, M.Pd">
                    </div>
                    @error('kaprodi')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email_prodi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" 
                               name="email_prodi" 
                               id="email_prodi"
                               value="{{ old('email_prodi', $prodi->email_prodi) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('email_prodi') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: matematika@unita.ac.id">
                    </div>
                    @error('email_prodi')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 4: No Telepon & Status -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <!-- No Telepon -->
                <div>
                    <label for="notelp_prodi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        No Telepon
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="notelp_prodi" 
                               id="notelp_prodi"
                               value="{{ old('notelp_prodi', $prodi->notelp_prodi) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('notelp_prodi') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: (0265) 123456">
                    </div>
                    @error('notelp_prodi')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status (Select2) -->
                <div>
                    <label for="status_prodi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <select name="status_prodi" 
                            id="status_prodi"
                            class="select2 w-full"
                            data-placeholder="Pilih Status"
                            data-allow-clear="false"
                            data-search="-1"
                            required>
                        <option value="1" {{ old('status_prodi', $prodi->status_prodi) == 1 ? 'selected' : '' }}>✅ Aktif</option>
                        <option value="0" {{ old('status_prodi', $prodi->status_prodi) == 0 ? 'selected' : '' }}>❌ Nonaktif</option>
                    </select>
                    @error('status_prodi')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-end gap-3">
                <a href="{{ route('admin.prodi.index') }}" 
                   class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 shadow-md shadow-amber-500/25 hover:shadow-lg hover:shadow-amber-500/30 text-sm font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Update Prodi
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
        $('#status_prodi').select2({
            placeholder: 'Pilih Status',
            allowClear: false,
            minimumResultsForSearch: -1,
            width: '100%',
            templateResult: formatStatus,
            templateSelection: formatStatusSelection
        });

        function formatStatus(state) {
            if (!state.id) {
                return state.text;
            }
            
            var isActive = state.id == 1;
            var dotColor = isActive ? 'bg-emerald-500' : 'bg-rose-500';
            var textColor = isActive ? 'text-emerald-600' : 'text-rose-600';
            
            var $state = $(
                '<span class="flex items-center gap-2">' +
                    '<span class="w-2 h-2 rounded-full ' + dotColor + '"></span>' +
                    '<span class="' + textColor + ' font-medium">' + state.text + '</span>' +
                '</span>'
            );
            return $state;
        }

        function formatStatusSelection(state) {
            if (!state.id) {
                return state.text;
            }
            
            var isActive = state.id == 1;
            var dotColor = isActive ? 'bg-emerald-500' : 'bg-rose-500';
            var textColor = isActive ? 'text-emerald-600' : 'text-rose-600';
            
            var $state = $(
                '<span class="flex items-center gap-2">' +
                    '<span class="w-2 h-2 rounded-full ' + dotColor + '"></span>' +
                    '<span class="' + textColor + ' font-medium">' + state.text + '</span>' +
                '</span>'
            );
            return $state;
        }
    });
</script>
@endsection