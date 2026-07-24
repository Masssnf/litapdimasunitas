@extends('layouts.admin')

@section('header', 'Detail Dosen')

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
                        <i class="fas fa-user-graduate text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail Dosen</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-blue-100 text-sm">Informasi lengkap data dosen</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $dosen->nidn }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.dosen.index') }}"
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
            <!-- KOLOM KIRI - DATA DOSEN                      -->
            <!-- ============================================= -->
            <div class="lg:col-span-2 space-y-5">
                <!-- Card Data Dosen -->
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

                    <!-- Card Header -->
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data Dosen</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap dosen</p>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <!-- Profile Header -->
                        <div class="flex items-center space-x-4 mb-6 pb-4 border-b border-gray-100">
                            <div
                                class="w-16 h-16 rounded-2xl flex items-center justify-center text-white font-bold text-2xl shadow-lg bg-gradient-to-br from-blue-500 to-cyan-500">
                                {{ strtoupper(substr($dosen->nama_dosen, 0, 1)) }}
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $dosen->nama_dosen }}</h2>
                                <div class="flex items-center space-x-3 mt-0.5">
                                    <span class="text-sm text-gray-500">{{ $dosen->nidn }}</span>
                                    <span class="w-px h-4 bg-gray-300"></span>
                                    <span
                                        class="text-sm text-gray-500">{{ $dosen->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Data Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- NIDN -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">NIDN</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 font-mono">{{ $dosen->nidn }}</p>
                            </div>

                            <!-- Nama -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Nama Dosen</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $dosen->nama_dosen }}</p>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Jenis Kelamin</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i
                                        class="fas fa-{{ $dosen->jenis_kelamin == 'L' ? 'mars' : 'venus' }} text-blue-500 text-sm"></i>
                                    {{ $dosen->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </p>
                            </div>

                            <!-- Status -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
                                <div class="mt-1">
                                    {!! $dosen->status_badge !!}
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-envelope text-blue-500 text-sm"></i>
                                    {{ $dosen->email_dosen ?? '-' }}
                                </p>
                            </div>

                            <!-- No Telepon -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">No Telepon</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-phone text-blue-500 text-sm"></i>
                                    {{ $dosen->notelp_dosen ?? '-' }}
                                </p>
                            </div>

                            <!-- Fakultas -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Fakultas</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-university text-blue-500 text-sm"></i>
                                    {{ $dosen->fakultas->nama_fakultas ?? '-' }}
                                </p>
                            </div>

                            <!-- Prodi -->
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Program Studi</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-center gap-2">
                                    <i class="fas fa-book-open text-blue-500 text-sm"></i>
                                    {{ $dosen->prodi->nama_prodi ?? '-' }}
                                </p>
                            </div>

                            <!-- Alamat (Full Width) -->
                            <div class="md:col-span-2 bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Alamat</p>
                                <p class="text-base font-semibold text-gray-800 mt-1 flex items-start gap-2">
                                    <i class="fas fa-map-marker-alt text-blue-500 text-sm mt-0.5"></i>
                                    {{ $dosen->alamat_dosen ?? '-' }}
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
                        <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-chart-pie text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Informasi</h3>
                            <p class="text-xs text-gray-400">Detail tambahan</p>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Info Fakultas & Prodi -->
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4">
                            <div class="space-y-3">
                                <div>
                                    <p class="text-xs text-gray-500 font-medium">Fakultas</p>
                                    <p class="text-lg font-bold text-blue-600 mt-0.5">
                                        {{ $dosen->fakultas->nama_fakultas ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $dosen->fakultas->kode_fakultas ?? '-' }}</p>
                                </div>
                                <div class="pt-2 border-t border-blue-200/50">
                                    <p class="text-xs text-gray-500 font-medium">Program Studi</p>
                                    <p class="text-lg font-bold text-cyan-600 mt-0.5">
                                        {{ $dosen->prodi->nama_prodi ?? '-' }}</p>
                                    <p class="text-xs text-gray-400">{{ $dosen->prodi->kode_prodi ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Info Tambahan -->
                        <div class="bg-gray-50/50 rounded-xl p-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Dibuat</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $dosen->created_at->format('d-m-Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Terakhir diubah</span>
                                <span
                                    class="text-gray-700 font-medium">{{ $dosen->updated_at->format('d-m-Y H:i') }}</span>
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
                            <p class="text-xs text-gray-400">Kelola data dosen</p>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        <a href="{{ route('admin.dosen.edit', $dosen->id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors duration-200">
                            <i class="fas fa-edit text-amber-500"></i>
                            <span class="text-sm font-medium">Edit Data Dosen</span>
                        </a>
                        <a href="{{ route('admin.fakultas.show', $dosen->fakultas_id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-indigo-50 text-indigo-700 hover:bg-indigo-100 transition-colors duration-200">
                            <i class="fas fa-university text-indigo-500"></i>
                            <span class="text-sm font-medium">Lihat Fakultas</span>
                        </a>
                        <a href="{{ route('admin.prodi.show', $dosen->prodi_id) }}"
                            class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 hover:bg-emerald-100 transition-colors duration-200">
                            <i class="fas fa-book-open text-emerald-500"></i>
                            <span class="text-sm font-medium">Lihat Program Studi</span>
                        </a>
                        <form action="{{ route('admin.dosen.destroy', $dosen->id) }}" method="POST" class="w-full"
                            onsubmit="return confirmDelete(this, '{{ $dosen->nama_dosen }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors duration-200">
                                <i class="fas fa-trash text-rose-500"></i>
                                <span class="text-sm font-medium">Hapus Dosen</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
