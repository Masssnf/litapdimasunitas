@extends('layouts.admin')

@section('header', 'Detail Program Studi')

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
                        <a href="{{ route('admin.prodi.index') }}"
                            class="ml-1 text-gray-500 hover:text-indigo-600 text-sm transition-colors">Program Studi</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                        <span class="ml-1 text-sm font-medium text-gray-700">Detail Program Studi</span>
                    </div>
                </li>
            </ol>
        </nav>

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
                        <i class="fas fa-book-open text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail Program Studi</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-emerald-100 text-sm">Informasi lengkap data program studi</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $prodi->kode_prodi }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.prodi.index') }}"
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
            <!-- KOLOM KIRI - DATA PRODI                      -->
            <!-- ============================================= -->
            <div class="lg:col-span-2 space-y-5">
                <!-- Card Data Prodi -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

                    <!-- Card Header -->
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-emerald-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data Program Studi</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap program studi</p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Kode -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kode Prodi</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 font-mono">{{ $prodi->kode_prodi }}</p>
                            </div>

                            <!-- Nama -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Nama Prodi</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $prodi->nama_prodi }}</p>
                            </div>

                            <!-- Jenjang -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Jenjang</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-graduation-cap text-emerald-500 text-sm"></i>
                                    {{ $prodi->jenjang_prodi }}
                                </p>
                            </div>

                            <!-- Status -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
                                <div class="mt-1">
                                    {!! $prodi->status_badge !!}
                                </div>
                            </div>

                            <!-- Kaprodi -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kaprodi</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-user-tie text-emerald-500 text-sm"></i>
                                    {{ $prodi->kaprodi ?? '-' }}
                                </p>
                            </div>

                            <!-- Fakultas -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Fakultas</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-university text-emerald-500 text-sm"></i>
                                    {{ $prodi->fakultas->nama_fakultas ?? '-' }}
                                </p>
                            </div>

                            <!-- Email -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-envelope text-emerald-500 text-sm"></i>
                                    {{ $prodi->email_prodi ?? '-' }}
                                </p>
                            </div>

                            <!-- No Telepon -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">No Telepon</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-phone text-emerald-500 text-sm"></i>
                                    {{ $prodi->notelp_prodi ?? '-' }}
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
                <!-- Card Info -->
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
                        <!-- Info Fakultas -->
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Fakultas</p>
                                    <p class="text-lg font-bold text-emerald-600 mt-1">
                                        {{ $prodi->fakultas->nama_fakultas ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $prodi->fakultas->kode_fakultas ?? '-' }}</p>
                                </div>
                                <div class="w-11 h-11 bg-emerald-200/50 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-university text-emerald-600 text-lg"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Info Tambahan -->
                        <div class="bg-gray-50/50 rounded-xl p-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $prodi->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Terakhir diubah</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $prodi->updated_at->format('d-m-Y H:i') }}</span>
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
                            <p class="text-xs text-gray-400">Kelola data program studi</p>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <a href="{{ route('admin.prodi.edit', $prodi->id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors duration-200">
                            <i class="fas fa-edit text-amber-500"></i>
                            <span class="text-sm font-medium">Edit Data Prodi</span>
                        </a>
                        <a href="{{ route('admin.fakultas.show', $prodi->fakultas_id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-colors duration-200">
                            <i class="fas fa-university text-indigo-500"></i>
                            <span class="text-sm font-medium">Lihat Fakultas</span>
                        </a>
                        <form action="{{ route('admin.prodi.destroy', $prodi->id) }}" method="POST" class="w-full"
                            onsubmit="return confirmDelete(this, '{{ $prodi->nama_prodi }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors duration-200">
                                <i class="fas fa-trash text-rose-500"></i>
                                <span class="text-sm font-medium">Hapus Prodi</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
