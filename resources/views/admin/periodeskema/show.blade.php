@extends('layouts.admin')

@section('header', 'Detail Periode Skema')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- HERO HEADER                                   -->
        <!-- ============================================= -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-rose-600 via-rose-500 to-pink-600 rounded-2xl shadow-xl shadow-rose-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-pink-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-calendar-check text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail Periode Skema</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-rose-100 text-sm">Informasi lengkap data periode skema</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $periodeSkema->periode->kode_periode ?? '' }} -
                                {{ $periodeSkema->skema->kode_skema ?? '' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.periodeskema.index') }}"
                        class="group relative px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- ============================================= -->
        <!-- CONTENT                                      -->
        <!-- ============================================= -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- ============================================= -->
            <!-- KOLOM KIRI - DATA PERIODE SKEMA              -->
            <!-- ============================================= -->
            <div class="lg:col-span-2 space-y-5">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-rose-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data Periode Skema</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap periode skema</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Periode</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-calendar-alt text-rose-500 text-sm"></i>
                                    {{ $periodeSkema->periode->nama_periode ?? '-' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $periodeSkema->periode->tahun_anggaran ?? '-' }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Skema</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-clipboard-list text-rose-500 text-sm"></i>
                                    {{ $periodeSkema->skema->nama_skema ?? '-' }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">{{ $periodeSkema->skema->kode_skema ?? '-' }}</p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Tanggal Pengajuan</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $periodeSkema->tanggal_mulai_pengajuan_formatted }}
                                    <span class="text-gray-400 text-sm">s.d</span>
                                    {{ $periodeSkema->tanggal_selesai_pengajuan_formatted }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
                                <div class="mt-1">
                                    {!! $periodeSkema->status_badge !!}
                                </div>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kuota Proposal</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-hashtag text-rose-500 text-sm"></i>
                                    {{ $periodeSkema->kuota_proposal }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Maksimal Anggota</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-users text-rose-500 text-sm"></i>
                                    {{ $periodeSkema->maksimal_anggota }} Orang
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Dana</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    <span class="text-emerald-600">{{ $periodeSkema->dana_minimal_formatted }}</span>
                                    <span class="text-gray-400"> - </span>
                                    <span class="text-rose-600">{{ $periodeSkema->dana_maksimal_formatted }}</span>
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Luaran Wajib</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-file-alt text-rose-500 text-sm"></i>
                                    {{ $periodeSkema->luaran_wajib ?? '-' }}
                                </p>
                            </div>

                            <!-- Tanggal Review & Pengumuman -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Tanggal Review</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $periodeSkema->tanggal_mulai_review_formatted }}
                                    <span class="text-gray-400 text-sm">s.d</span>
                                    {{ $periodeSkema->tanggal_selesai_review_formatted }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Tanggal Pengumuman</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-calendar-check text-rose-500 text-sm"></i>
                                    {{ $periodeSkema->tanggal_pengumuman_formatted }}
                                </p>
                            </div>

                            <!-- Keterangan (Full Width) -->
                            <div class="md:col-span-2 bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Keterangan</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $periodeSkema->keterangan ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================= -->
            <!-- KOLOM KANAN - STATISTIK & AKSI               -->
            <!-- ============================================= -->
            <div class="space-y-5">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-chart-pie text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Informasi</h3>
                            <p class="text-xs text-gray-400">Detail tambahan</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div class="bg-gradient-to-br from-rose-50 to-pink-50 rounded-xl p-4">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Periode</p>
                                    <p class="text-lg font-bold text-rose-600 mt-0.5">
                                        {{ $periodeSkema->periode->nama_periode ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $periodeSkema->periode->tahun_anggaran ?? '-' }}
                                    </p>
                                </div>
                                <div class="pt-2 border-t border-rose-200/50">
                                    <p class="text-xs text-gray-500 font-medium">Skema</p>
                                    <p class="text-lg font-bold text-pink-600 mt-0.5">
                                        {{ $periodeSkema->skema->nama_skema ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $periodeSkema->skema->kode_skema ?? '-' }}</p>
                                </div>
                                <div class="pt-2 border-t border-rose-200/50">
                                    <p class="text-xs text-gray-500 font-medium">Status</p>
                                    <div class="mt-1">
                                        {!! $periodeSkema->status_badge !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50/50 rounded-xl p-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $periodeSkema->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Terakhir diubah</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $periodeSkema->updated_at->format('d-m-Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center">
                            <i class="fas fa-bolt text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Aksi Cepat</h3>
                            <p class="text-xs text-gray-400">Kelola data periode skema</p>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <a href="{{ route('admin.periodeskema.edit', $periodeSkema->id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors duration-200">
                            <i class="fas fa-edit text-amber-500"></i>
                            <span class="text-sm font-medium">Edit Data</span>
                        </a>
                        <a href="{{ route('admin.periode.show', $periodeSkema->periode_id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors duration-200">
                            <i class="fas fa-calendar-alt text-emerald-500"></i>
                            <span class="text-sm font-medium">Lihat Periode</span>
                        </a>
                        <a href="{{ route('admin.skema.show', $periodeSkema->skema_id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors duration-200">
                            <i class="fas fa-clipboard-list text-blue-500"></i>
                            <span class="text-sm font-medium">Lihat Skema</span>
                        </a>
                        <form action="{{ route('admin.periodeskema.destroy', $periodeSkema->id) }}" method="POST"
                            class="w-full"
                            onsubmit="return confirmDelete(this, '{{ $periodeSkema->periode->nama_periode ?? '' }} - {{ $periodeSkema->skema->nama_skema ?? '' }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors duration-200">
                                <i class="fas fa-trash text-rose-500"></i>
                                <span class="text-sm font-medium">Hapus Data</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
