@extends('layouts.admin')

@section('header', 'Detail Fakultas')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- BREADCRUMB                                   -->
        <!-- ============================================= -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-indigo-600 text-sm transition-colors">
                        <i class="fas fa-home mr-1"></i> Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                        <a href="{{ route('admin.fakultas.index') }}"
                            class="ml-1 text-gray-500 hover:text-indigo-600 text-sm transition-colors">Fakultas</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                        <span class="ml-1 text-sm font-medium text-gray-700">Detail Fakultas</span>
                    </div>
                </li>
            </ol>
        </nav>

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
                        <i class="fas fa-university text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail Fakultas</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-indigo-100 text-sm">Informasi lengkap data fakultas</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $fakultas->kode_fakultas }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.fakultas.index') }}"
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
            <!-- KOLOM KIRI - DATA FAKULTAS                   -->
            <!-- ============================================= -->
            <div class="lg:col-span-2 space-y-5">
                <!-- Card Data Fakultas -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

                    <!-- Card Header -->
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data Fakultas</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap fakultas</p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Kode -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kode Fakultas</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 font-mono">
                                    {{ $fakultas->kode_fakultas }}</p>
                            </div>

                            <!-- Nama -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Nama Fakultas</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $fakultas->nama_fakultas }}</p>
                            </div>

                            <!-- Dekan -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Dekan</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-user-tie text-indigo-500 text-sm"></i>
                                    {{ $fakultas->dekan_fakultas ?? '-' }}
                                </p>
                            </div>

                            <!-- Status (Menggunakan Accessor) -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
                                <div class="mt-1">
                                    {!! $fakultas->status_badge !!}
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-envelope text-indigo-500 text-sm"></i>
                                    {{ $fakultas->email_fakultas ?? '-' }}
                                </p>
                            </div>

                            <!-- No Telepon -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">No Telepon</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-phone text-indigo-500 text-sm"></i>
                                    {{ $fakultas->notelp_fakultas ?? '-' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================= -->
            <!-- KOLOM KANAN - STATISTIK                      -->
            <!-- ============================================= -->
            <div class="space-y-5">
                <!-- Card Info -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-chart-pie text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Statistik</h3>
                            <p class="text-xs text-gray-400">Informasi tambahan</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        {{-- <!-- Total Prodi -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Total Program Studi</p>
                                <p class="text-2xl font-bold text-indigo-600 mt-1">{{ $fakultas->prodi->count() ?? 0 }}</p>
                            </div>
                            <div class="w-11 h-11 bg-indigo-200/50 rounded-xl flex items-center justify-center">
                                <i class="fas fa-book-open text-indigo-600 text-lg"></i>
                            </div>
                        </div>
                    </div> --}}

                        <!-- Info Tambahan -->
                        <div class="bg-gray-50/50 rounded-xl p-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $fakultas->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Terakhir diubah</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $fakultas->updated_at->format('d-m-Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Aksi Cepat -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center">
                            <i class="fas fa-bolt text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Aksi Cepat</h3>
                            <p class="text-xs text-gray-400">Kelola data fakultas</p>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <a href="{{ route('admin.fakultas.edit', $fakultas->id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors duration-200">
                            <i class="fas fa-edit text-amber-500"></i>
                            <span class="text-sm font-medium">Edit Data Fakultas</span>
                        </a>
                        <form action="{{ route('admin.fakultas.destroy', $fakultas->id) }}" method="POST" class="w-full"
                            onsubmit="return confirmDelete(this, '{{ $fakultas->nama_fakultas }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors duration-200">
                                <i class="fas fa-trash text-rose-500"></i>
                                <span class="text-sm font-medium">Hapus Fakultas</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
