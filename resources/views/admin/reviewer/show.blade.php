@extends('layouts.admin')

@section('header', 'Detail Reviewer')

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
                        <i class="fas fa-user-check text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail Reviewer</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-teal-100 text-sm">Informasi lengkap data reviewer</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $reviewer->kode_reviewer }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.reviewer.index') }}"
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
            <!-- KOLOM KIRI - DATA REVIEWER                   -->
            <!-- ============================================= -->
            <div class="lg:col-span-2 space-y-5">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-teal-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-teal-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data Reviewer</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap reviewer</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <!-- Profile Header -->
                        <div class="flex items-center space-x-4 mb-6 pb-4 border-b border-gray-100">
                            <div
                                class="w-16 h-16 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg bg-gradient-to-br from-teal-500 to-cyan-500">
                                {{ strtoupper(substr($reviewer->nama_reviewer, 0, 1)) }}
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $reviewer->nama_reviewer }}</h2>
                                <div class="flex items-center space-x-3 mt-0.5">
                                    <span class="text-sm text-gray-500">{{ $reviewer->kode_reviewer }}</span>
                                    <span class="w-px h-4 bg-gray-300"></span>
                                    <span class="text-sm text-gray-500">{{ $reviewer->nidn_reviewer ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Data Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kode Reviewer</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 font-mono">
                                    {{ $reviewer->kode_reviewer }}</p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Nama Reviewer</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $reviewer->nama_reviewer }}</p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">NIDN</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $reviewer->nidn_reviewer ?? '-' }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
                                <div class="mt-1">
                                    {!! $reviewer->status_badge !!}
                                </div>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Jenis Reviewer</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-tags text-teal-500 text-sm"></i>
                                    {{ $reviewer->jenisreviewer->nama_jenisreviewer ?? '-' }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Instansi</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-building text-teal-500 text-sm"></i>
                                    {{ $reviewer->instansi_reviewer ?? '-' }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-envelope text-teal-500 text-sm"></i>
                                    {{ $reviewer->email_reviewer ?? '-' }}
                                </p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">No Telepon</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-phone text-teal-500 text-sm"></i>
                                    {{ $reviewer->notelp_reviewer ?? '-' }}
                                </p>
                            </div>

                            <!-- Dosen (Full Width) -->
                            <div class="md:col-span-2 bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Dosen Terkait</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-chalkboard-teacher text-teal-500 text-sm"></i>
                                    {{ $reviewer->dosen->nama_dosen ?? 'Tidak ada dosen terkait' }}
                                </p>
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
                        <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-xl p-4">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Jenis Reviewer</p>
                                    <p class="text-lg font-bold text-teal-600 mt-0.5">
                                        {{ $reviewer->jenisreviewer->nama_jenisreviewer ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">
                                        {{ $reviewer->jenisreviewer->kode_jenisreviewer ?? '-' }}</p>
                                </div>
                                <div class="pt-2 border-t border-teal-200/50">
                                    <p class="text-xs text-gray-500 font-medium">Dosen Terkait</p>
                                    <p class="text-lg font-bold text-cyan-600 mt-0.5">
                                        {{ $reviewer->dosen->nama_dosen ?? 'Tidak ada' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50/50 rounded-xl p-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $reviewer->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Terakhir diubah</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $reviewer->updated_at->format('d-m-Y H:i') }}</span>
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
                            <p class="text-xs text-gray-400">Kelola data reviewer</p>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <a href="{{ route('admin.reviewer.edit', $reviewer->id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors duration-200">
                            <i class="fas fa-edit text-amber-500"></i>
                            <span class="text-sm font-medium">Edit Data Reviewer</span>
                        </a>
                        <a href="{{ route('admin.jenisreviewer.show', $reviewer->jenisreviewer_id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-purple-50 text-purple-700 hover:bg-purple-100 transition-colors duration-200">
                            <i class="fas fa-tags text-purple-500"></i>
                            <span class="text-sm font-medium">Lihat Jenis Reviewer</span>
                        </a>
                        @if ($reviewer->dosen_id)
                            <a href="{{ route('admin.dosen.show', $reviewer->dosen_id) }}"
                                class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors duration-200">
                                <i class="fas fa-chalkboard-teacher text-blue-500"></i>
                                <span class="text-sm font-medium">Lihat Dosen Terkait</span>
                            </a>
                        @endif
                        <form action="{{ route('admin.reviewer.destroy', $reviewer->id) }}" method="POST"
                            class="w-full" onsubmit="return confirmDelete(this, '{{ $reviewer->nama_reviewer }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors duration-200">
                                <i class="fas fa-trash text-rose-500"></i>
                                <span class="text-sm font-medium">Hapus Reviewer</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
