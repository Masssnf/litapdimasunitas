@extends('layouts.admin')

@section('header', 'Edit Periode Skema')

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
                    <h1 class="text-2xl font-bold text-white tracking-tight">Edit Periode Skema</h1>
                    <div class="flex items-center space-x-3 mt-0.5">
                        <span class="text-amber-100 text-sm">Ubah informasi data periode skema</span>
                        <span class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                            {{ $periodeSkema->periode->kode_periode ?? '' }} - {{ $periodeSkema->skema->kode_skema ?? '' }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.periodeskema.index') }}"
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
                <i class="fas fa-calendar-check text-amber-600"></i>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-gray-700">Form Edit Periode Skema</h3>
                <p class="text-xs text-gray-400">Ubah data periode skema di bawah ini</p>
            </div>
        </div>

        <form action="{{ route('admin.periodeskema.update', $periodeSkema->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <!-- BARIS 1: Periode & Skema -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="periode_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Periode <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                        </div>
                        <select name="periode_id" 
                                id="periode_id"
                                class="select2 w-full @error('periode_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Periode"
                                required>
                            <option value="">Pilih Periode</option>
                            @foreach($periode as $item)
                                <option value="{{ $item->id }}" {{ old('periode_id', $periodeSkema->periode_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_periode }} - {{ $item->nama_periode }} ({{ $item->tahun_anggaran }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('periode_id')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="skema_id" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Skema <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-clipboard-list text-gray-400"></i>
                        </div>
                        <select name="skema_id" 
                                id="skema_id"
                                class="select2 w-full @error('skema_id') border-rose-500 focus:ring-rose-500 @enderror"
                                data-placeholder="Pilih Skema"
                                required>
                            <option value="">Pilih Skema</option>
                            @foreach($skema as $item)
                                <option value="{{ $item->id }}" {{ old('skema_id', $periodeSkema->skema_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_skema }} - {{ $item->nama_skema }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('skema_id')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 2: Tanggal Mulai & Selesai Pengajuan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="tanggal_mulai_pengajuan" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tanggal Mulai Pengajuan <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-plus text-gray-400"></i>
                        </div>
                        <input type="date" 
                               name="tanggal_mulai_pengajuan" 
                               id="tanggal_mulai_pengajuan"
                               value="{{ old('tanggal_mulai_pengajuan', $periodeSkema->tanggal_mulai_pengajuan ? $periodeSkema->tanggal_mulai_pengajuan->format('Y-m-d') : '') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('tanggal_mulai_pengajuan') border-rose-500 focus:ring-rose-500 @enderror"
                               required>
                    </div>
                    @error('tanggal_mulai_pengajuan')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_selesai_pengajuan" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tanggal Selesai Pengajuan <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-minus text-gray-400"></i>
                        </div>
                        <input type="date" 
                               name="tanggal_selesai_pengajuan" 
                               id="tanggal_selesai_pengajuan"
                               value="{{ old('tanggal_selesai_pengajuan', $periodeSkema->tanggal_selesai_pengajuan ? $periodeSkema->tanggal_selesai_pengajuan->format('Y-m-d') : '') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('tanggal_selesai_pengajuan') border-rose-500 focus:ring-rose-500 @enderror"
                               required>
                    </div>
                    @error('tanggal_selesai_pengajuan')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 3: Tanggal Mulai & Selesai Review -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="tanggal_mulai_review" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tanggal Mulai Review
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-plus text-gray-400"></i>
                        </div>
                        <input type="date" 
                               name="tanggal_mulai_review" 
                               id="tanggal_mulai_review"
                               value="{{ old('tanggal_mulai_review', $periodeSkema->tanggal_mulai_review ? $periodeSkema->tanggal_mulai_review->format('Y-m-d') : '') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('tanggal_mulai_review') border-rose-500 focus:ring-rose-500 @enderror">
                    </div>
                    @error('tanggal_mulai_review')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_selesai_review" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tanggal Selesai Review
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-minus text-gray-400"></i>
                        </div>
                        <input type="date" 
                               name="tanggal_selesai_review" 
                               id="tanggal_selesai_review"
                               value="{{ old('tanggal_selesai_review', $periodeSkema->tanggal_selesai_review ? $periodeSkema->tanggal_selesai_review->format('Y-m-d') : '') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('tanggal_selesai_review') border-rose-500 focus:ring-rose-500 @enderror">
                    </div>
                    @error('tanggal_selesai_review')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 4: Tanggal Pengumuman & Kuota Proposal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="tanggal_pengumuman" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tanggal Pengumuman
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-calendar-check text-gray-400"></i>
                        </div>
                        <input type="date" 
                               name="tanggal_pengumuman" 
                               id="tanggal_pengumuman"
                               value="{{ old('tanggal_pengumuman', $periodeSkema->tanggal_pengumuman ? $periodeSkema->tanggal_pengumuman->format('Y-m-d') : '') }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('tanggal_pengumuman') border-rose-500 focus:ring-rose-500 @enderror">
                    </div>
                    @error('tanggal_pengumuman')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="kuota_proposal" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Kuota Proposal <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-hashtag text-gray-400"></i>
                        </div>
                        <input type="number" 
                               name="kuota_proposal" 
                               id="kuota_proposal"
                               value="{{ old('kuota_proposal', $periodeSkema->kuota_proposal) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('kuota_proposal') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: 10"
                               min="1"
                               required>
                    </div>
                    @error('kuota_proposal')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 5: Dana Minimal & Dana Maksimal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="dana_minimal" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Dana Minimal <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-money-bill-wave text-gray-400"></i>
                        </div>
                        <input type="number" 
                               name="dana_minimal" 
                               id="dana_minimal"
                               value="{{ old('dana_minimal', $periodeSkema->dana_minimal) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('dana_minimal') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: 1000000"
                               min="0"
                               step="1000"
                               required>
                    </div>
                    @error('dana_minimal')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="dana_maksimal" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Dana Maksimal <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-money-bill-wave text-gray-400"></i>
                        </div>
                        <input type="number" 
                               name="dana_maksimal" 
                               id="dana_maksimal"
                               value="{{ old('dana_maksimal', $periodeSkema->dana_maksimal) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('dana_maksimal') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: 5000000"
                               min="0"
                               step="1000"
                               required>
                    </div>
                    @error('dana_maksimal')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 6: Maksimal Anggota & Luaran Wajib -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="maksimal_anggota" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Maksimal Anggota <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-users text-gray-400"></i>
                        </div>
                        <input type="number" 
                               name="maksimal_anggota" 
                               id="maksimal_anggota"
                               value="{{ old('maksimal_anggota', $periodeSkema->maksimal_anggota) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('maksimal_anggota') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: 5"
                               min="1"
                               required>
                    </div>
                    @error('maksimal_anggota')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="luaran_wajib" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Luaran Wajib
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-file-alt text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="luaran_wajib" 
                               id="luaran_wajib"
                               value="{{ old('luaran_wajib', $periodeSkema->luaran_wajib) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('luaran_wajib') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Contoh: Publikasi Jurnal">
                    </div>
                    @error('luaran_wajib')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- BARIS 7: Status & Keterangan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Status <span class="text-rose-500">*</span>
                    </label>
                    <select name="status" 
                            id="status"
                            class="select2 w-full"
                            data-placeholder="Pilih Status"
                            data-allow-clear="false"
                            data-search="-1"
                            required>
                        <option value="1" {{ old('status', $periodeSkema->status) == 1 ? 'selected' : '' }}>✅ Aktif</option>
                        <option value="0" {{ old('status', $periodeSkema->status) == 0 ? 'selected' : '' }}>❌ Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Keterangan
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-align-left text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="keterangan" 
                               id="keterangan"
                               value="{{ old('keterangan', $periodeSkema->keterangan) }}"
                               class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition @error('keterangan') border-rose-500 focus:ring-rose-500 @enderror"
                               placeholder="Keterangan tambahan">
                    </div>
                    @error('keterangan')
                        <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-6 pt-4 border-t border-gray-100 flex flex-wrap justify-end gap-3">
                <a href="{{ route('admin.periodeskema.index') }}" 
                   class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 shadow-md shadow-amber-500/25 hover:shadow-lg hover:shadow-amber-500/30 text-sm font-medium">
                    <i class="fas fa-save mr-2"></i>
                    Update Periode Skema
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#periode_id').select2({
            placeholder: 'Pilih Periode',
            allowClear: false,
            width: '100%'
        });

        $('#skema_id').select2({
            placeholder: 'Pilih Skema',
            allowClear: false,
            width: '100%'
        });

        $('#status').select2({
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