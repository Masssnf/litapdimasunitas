@extends('layouts.admin')

@section('header', 'Manajemen Fakultas')

@section('content')
    <div class="space-y-5">

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
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Manajemen Fakultas</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-indigo-100 text-sm">Kelola semua data fakultas di lingkungan kampus</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $fakultas->total() }} Fakultas
                            </span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.fakultas.create') }}"
                    class="group relative px-5 py-2.5 bg-white text-indigo-600 font-semibold rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 flex items-center text-sm overflow-hidden">
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-indigo-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative flex items-center">
                        <svg class="w-4 h-4 mr-2 group-hover:rotate-90 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Fakultas
                    </span>
                </a>
            </div>
        </div>

        <!-- ============================================= -->
        <!-- STATISTIK CARD                                -->
        <!-- ============================================= -->                         
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total Fakultas</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total ?? $fakultas->total() }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <span class="text-xs text-gray-400">Total seluruh fakultas</span>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Fakultas Aktif</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $aktif ?? 0 }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <span class="text-xs text-emerald-500">● Status aktif</span>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Fakultas Nonaktif</p>
                        <p class="text-2xl font-bold text-rose-600 mt-1">{{ $nonaktif ?? 0 }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl flex items-center justify-center shadow-lg shadow-rose-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <span class="text-xs text-rose-500">● Status nonaktif</span>
                </div>
            </div>
        </div>

        <!-- ============================================= -->
        <!-- TABLE                                        -->
        <!-- ============================================= -->
        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

            <!-- Toolbar -->
            <div class="px-5 py-3.5 border-b border-gray-100 flex flex-wrap justify-between items-center gap-3">
                <div class="flex items-center space-x-4">
                    <h1 class="text-2xl font-bold text-indigo-600 tracking-tight">Tabel Data Fakultas</h1>
                </div>

                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari kode atau nama fakultas..."
                            class="pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400/30 focus:border-indigo-300 focus:bg-white transition-all duration-200 w-40 focus:w-52 text-gray-700 placeholder:text-gray-400">
                    </div>
                    <button type="submit" form="searchForm"
                        class="w-9 h-9 rounded-xl bg-gray-50 hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3.5 px-5 text-left w-12">#</th>
                            <th class="py-3.5 px-5 text-left">Kode</th>
                            <th class="py-3.5 px-5 text-left">Nama Fakultas</th>
                            <th class="py-3.5 px-5 text-left hidden lg:table-cell">Dekan</th>
                            <th class="py-3.5 px-5 text-left hidden xl:table-cell">Email</th>
                            <th class="py-3.5 px-5 text-left hidden xl:table-cell">No Telepon</th>
                            <th class="py-3.5 px-5 text-left">Status</th>
                            <th class="py-3.5 px-5 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($fakultas as $index => $item)
                            <tr class="hover:bg-indigo-50/30 transition duration-200 group">
                                <td class="py-3.5 px-5 text-gray-400 text-sm text-center font-mono">
                                    {{ $fakultas->firstItem() + $index }}</td>

                                <!-- Kode -->
                                <td class="py-3.5 px-5">
                                    <span
                                        class="font-mono text-sm font-medium text-gray-700">{{ $item->kode_fakultas }}</span>
                                </td>

                                <!-- Nama Fakultas -->
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center space-x-3.5">
                                        <div class="relative flex-shrink-0">
                                            <div
                                                class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-semibold text-sm shadow-sm bg-gradient-to-br from-indigo-500 to-purple-500">
                                                {{ strtoupper(substr($item->nama_fakultas, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800 text-sm">
                                                {{ $item->nama_fakultas }}
                                            </div>
                                            <div class="text-[10px] text-gray-400 hidden lg:flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $item->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Dekan -->
                                <td class="py-3.5 px-5 text-gray-600 text-sm hidden lg:table-cell">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-300 mr-2.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>{{ $item->dekan_fakultas ?? '-' }}</span>
                                    </div>
                                </td>

                                <!-- Email -->
                                <td class="py-3.5 px-5 text-gray-600 text-sm hidden xl:table-cell">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-300 mr-2.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <span class="truncate max-w-[150px]">{{ $item->email_fakultas ?? '-' }}</span>
                                    </div>
                                </td>

                                <!-- No Telepon -->
                                <td class="py-3.5 px-5 text-gray-600 text-sm hidden xl:table-cell">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-gray-300 mr-2.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span>{{ $item->notelp_fakultas ?? '-' }}</span>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="py-3.5 px-5">
                                    @if ($item->status_fakultas)
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-semibold bg-emerald-100 text-emerald-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-semibold bg-rose-100 text-rose-700">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="py-3.5 px-5">
                                    <div class="flex items-center justify-center space-x-1">
                                        <!-- Detail -->
                                        <a href="{{ route('admin.fakultas.show', $item->id) }}"
                                            class="w-8 h-8 rounded-xl hover:bg-indigo-50 text-gray-400 hover:text-indigo-600 transition flex items-center justify-center group"
                                            title="Detail">
                                            <i class="fas fa-eye text-sm group-hover:scale-110 transition"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('admin.fakultas.edit', $item->id) }}"
                                            class="w-8 h-8 rounded-xl hover:bg-amber-50 text-gray-400 hover:text-amber-600 transition flex items-center justify-center group"
                                            title="Edit">
                                            <i class="fas fa-edit text-sm group-hover:scale-110 transition"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('admin.fakultas.destroy', $item->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirmDelete(this, '{{ $item->nama_fakultas }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-xl hover:bg-rose-50 text-gray-400 hover:text-rose-600 transition flex items-center justify-center group"
                                                title="Hapus">
                                                <i class="fas fa-trash text-sm group-hover:scale-110 transition"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada data fakultas</p>
                                        <p class="text-sm text-gray-400 mt-1">Klik tombol "Tambah Fakultas" untuk memulai
                                        </p>
                                        <a href="{{ route('admin.fakultas.create') }}"
                                            class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-100 transition text-sm font-medium">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                            Tambah Fakultas Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div
                class="px-5 py-3.5 border-t border-gray-100 bg-gray-50/30 flex flex-wrap justify-between items-center gap-3">
                <div class="text-xs text-gray-500">
                    Menampilkan <span class="font-semibold text-gray-700">{{ $fakultas->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-700">{{ $fakultas->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-700">{{ $fakultas->total() }}</span>
                </div>
                <div>
                    {{ $fakultas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
