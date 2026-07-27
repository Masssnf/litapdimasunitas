@extends('layouts.admin')

@section('header', 'Edit Jenis Skema')

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
                    <h1 class="text-2xl font-bold text-white tracking-tight">Edit Jenis Skema</h1>
                    <div class="flex items-center space-x-3 mt-0.5">
                        <span class="text-amber-100 text-sm">Ubah informasi data jenis skema</span>
                        <span class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                            {{ $jenisskema->kode_jenisskema }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.jenisskema.index') }}"
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
                <i class="fas fa-layer-group text-amber-600"></i>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700">Form Edit Jenis Skema</h3>
                <p class="text-xs text-gray-400">Ubah data jenis skema di bawah ini</p>
            </div>
        </div>

        <form action="{{ route('admin.jenisskema.update', $jenisskema->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- BARIS 1: Kode & Nama -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="kode_jenisskema" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kode Jenis Skema <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="kode_jenisskema" 
                               id="kode_jenisskema"
                               value="{{ old('kode_jenisskema', $jenisskema->kode_jenisskema) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('kode_jenisskema') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: SK-001" 
                               required>
                    </div>
                    @error('kode_jenisskema')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="nama_jenisskema" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Jenis Skema <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="nama_jenisskema" 
                               id="nama_jenisskema"
                               value="{{ old('nama_jenisskema', $jenisskema->nama_jenisskema) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('nama_jenisskema') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: Skema Penelitian Dasar" 
                               required>
                    </div>
                    @error('nama_jenisskema')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 2: Deskripsi (Full Width) -->
            <div class="mt-4">
                <label for="deskripsi_jenisskema" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Deskripsi
                </label>
                <div class="relative">
                    <div class="absolute top-3 left-3 pointer-events-none">
                        <i class="fas fa-align-left text-gray-400"></i>
                    </div>
                    <textarea name="deskripsi_jenisskema" 
                              id="deskripsi_jenisskema" 
                              rows="3"
                              class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('deskripsi_jenisskema') border-rose-500 focus:ring-rose-500 @enderror"
                              placeholder="Masukkan deskripsi jenis skema">{{ old('deskripsi_jenisskema', $jenisskema->deskripsi_jenisskema) }}</textarea>
                </div>
                @error('deskripsi_jenisskema')
                    <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- BARIS 3: Status -->
            <div class="mt-4">
                <label for="status_jenisskema" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Status <span class="text-rose-500">*</span>
                </label>
                <select name="status_jenisskema" 
                        id="status_jenisskema"
                        class="select2 w-full"
                        data-placeholder="Pilih Status"
                        data-allow-clear="false"
                        data-search="-1"
                        required>
                    <option value="1" {{ old('status_jenisskema', $jenisskema->status_jenisskema) == 1 ? 'selected' : '' }}>✅ Aktif</option>
                    <option value="0" {{ old('status_jenisskema', $jenisskema->status_jenisskema) == 0 ? 'selected' : '' }}>❌ Nonaktif</option>
                </select>
                @error('status_jenisskema')
                    <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-end gap-3">
                <a href="{{ route('admin.jenisskema.index') }}" 
                   class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 shadow-md shadow-amber-500/25 hover:shadow-lg hover:shadow-amber-500/30 text-sm font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Update Jenis Skema
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#status_jenisskema').select2({
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