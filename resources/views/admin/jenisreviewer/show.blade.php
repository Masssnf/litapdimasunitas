@extends('layouts.admin')

@section('header', 'Detail Jenis Reviewer')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- HERO HEADER                                   -->
        <!-- ============================================= -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-purple-600 via-purple-500 to-pink-600 rounded-2xl shadow-xl shadow-purple-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-pink-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-tags text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail Jenis Reviewer</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-purple-100 text-sm">Informasi lengkap data jenis reviewer</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $jenisreviewer->kode_jenisreviewer }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.jenisreviewer.index') }}"
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
            <!-- KOLOM KIRI - DATA JENIS REVIEWER             -->
            <!-- ============================================= -->
            <div class="lg:col-span-2 space-y-5">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data Jenis Reviewer</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap jenis reviewer</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kode Jenis Reviewer
                                </p>
                                <p class="text-base font-semibold text-gray-800 mt-1 font-mono">
                                    {{ $jenisreviewer->kode_jenisreviewer }}</p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Nama Jenis Reviewer
                                </p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $jenisreviewer->nama_jenisreviewer }}</p>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
                                <div class="mt-1">
                                    {!! $jenisreviewer->status_badge !!}
                                </div>
                            </div>

                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Total Reviewer</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-users text-purple-500 text-sm"></i>
                                    {{ $jenisreviewer->reviewer->count() ?? 0 }} Reviewer
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
                        <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Total Reviewer</p>
                                    <p class="text-2xl font-bold text-purple-600 mt-1">
                                        {{ $jenisreviewer->reviewer->count() ?? 0 }}</p>
                                </div>
                                <div class="w-11 h-11 bg-purple-200/50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-users text-purple-600 text-lg"></i>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50/50 rounded-xl p-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $jenisreviewer->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Terakhir diubah</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $jenisreviewer->updated_at->format('d-m-Y H:i') }}</span>
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
                            <p class="text-xs text-gray-400">Kelola data jenis reviewer</p>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <a href="{{ route('admin.jenisreviewer.edit', $jenisreviewer->id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors duration-200">
                            <i class="fas fa-edit text-amber-500"></i>
                            <span class="text-sm font-medium">Edit Data</span>
                        </a>
                        <form action="{{ route('admin.jenisreviewer.destroy', $jenisreviewer->id) }}" method="POST"
                            class="w-full"
                            onsubmit="return confirmDelete(this, '{{ $jenisreviewer->nama_jenisreviewer }}')">
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
