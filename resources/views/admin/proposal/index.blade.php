@extends('layouts.admin')

@section('header', 'Manajemen Proposal')

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
                        <i class="fas fa-file-alt text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Manajemen Proposal</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-indigo-100 text-sm">Kelola semua data proposal</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $proposal->total() }} Proposal
                            </span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.proposal.create') }}"
                    class="group relative px-5 py-2.5 bg-white text-indigo-600 font-semibold rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 flex items-center text-sm overflow-hidden">
                    <span
                        class="absolute inset-0 bg-gradient-to-r from-indigo-50 to-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative flex items-center">
                        <i class="fas fa-plus-circle mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                        Tambah Proposal
                    </span>
                </a>
            </div>
        </div>

        <!-- ============================================= -->
        <!-- STATISTIK CARD                               -->
        <!-- ============================================= -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3">
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-3 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Total</p>
                        <p class="text-lg font-bold text-gray-800 mt-0.5">{{ $total ?? 0 }}</p>
                    </div>
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-600 rounded-xl flex items-center justify-center shadow-lg shadow-gray-500/25">
                        <i class="fas fa-file-alt text-white text-xs"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-3 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Draft</p>
                        <p class="text-lg font-bold text-gray-600 mt-0.5">{{ $draft ?? 0 }}</p>
                    </div>
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-500 rounded-xl flex items-center justify-center shadow-lg shadow-gray-500/25">
                        <i class="fas fa-pencil-alt text-white text-xs"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-3 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Diajukan</p>
                        <p class="text-lg font-bold text-blue-600 mt-0.5">{{ $diajukan ?? 0 }}</p>
                    </div>
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/25">
                        <i class="fas fa-paper-plane text-white text-xs"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-3 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Diverifikasi</p>
                        <p class="text-lg font-bold text-indigo-600 mt-0.5">{{ $diverifikasi ?? 0 }}</p>
                    </div>
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/25">
                        <i class="fas fa-check-double text-white text-xs"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-3 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Review</p>
                        <p class="text-lg font-bold text-yellow-600 mt-0.5">{{ $direview ?? 0 }}</p>
                    </div>
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/25">
                        <i class="fas fa-search text-white text-xs"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-3 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Revisi</p>
                        <p class="text-lg font-bold text-orange-600 mt-0.5">{{ $revisi ?? 0 }}</p>
                    </div>
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/25">
                        <i class="fas fa-undo text-white text-xs"></i>
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-3 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 font-medium">Lolos</p>
                        <p class="text-lg font-bold text-emerald-600 mt-0.5">{{ $lolos ?? 0 }}</p>
                    </div>
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                        <i class="fas fa-check-circle text-white text-xs"></i>
                    </div>
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
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Total:</span>
                        <span class="text-sm font-bold text-gray-800">{{ $proposal->total() }}</span>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <form method="GET" action="{{ route('admin.proposal.index') }}" class="flex items-center space-x-2">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari proposal..."
                                class="pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400/30 focus:border-indigo-300 focus:bg-white transition-all duration-200 w-40 focus:w-52 text-gray-700 placeholder:text-gray-400">
                        </div>

                        <select name="status"
                            class="py-2 px-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-400/30 focus:border-indigo-300 focus:bg-white transition-all duration-200 text-gray-700">
                            <option value="">Semua Status</option>
                            <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Diajukan" {{ request('status') == 'Diajukan' ? 'selected' : '' }}>Diajukan
                            </option>
                            <option value="Diverifikasi" {{ request('status') == 'Diverifikasi' ? 'selected' : '' }}>
                                Diverifikasi</option>
                            <option value="Direview" {{ request('status') == 'Direview' ? 'selected' : '' }}>Direview
                            </option>
                            <option value="Revisi" {{ request('status') == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                            <option value="Lolos" {{ request('status') == 'Lolos' ? 'selected' : '' }}>Lolos</option>
                            <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>

                        <button type="submit"
                            class="w-9 h-9 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white transition flex items-center justify-center">
                            <i class="fas fa-search text-sm"></i>
                        </button>
                        @if (request('search') || request('status'))
                            <a href="{{ route('admin.proposal.index') }}"
                                class="w-9 h-9 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-700 transition flex items-center justify-center">
                                <i class="fas fa-times text-sm"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 text-xs font-semibold uppercase tracking-wider">
                            <th class="py-3.5 px-5 text-center w-12">#</th>
                            <th class="py-3.5 px-5 text-left">Kode</th>
                            <th class="py-3.5 px-5 text-left">Judul</th>
                            <th class="py-3.5 px-5 text-left hidden lg:table-cell">Ketua</th>
                            <th class="py-3.5 px-5 text-center hidden xl:table-cell">Dana</th>
                            <th class="py-3.5 px-5 text-center">Status</th>
                            <th class="py-3.5 px-5 text-center w-44">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($proposal as $index => $item)
                            <tr class="hover:bg-indigo-50/30 transition duration-200 group">
                                <td class="py-3.5 px-5 text-gray-400 text-sm text-center font-mono">
                                    {{ $proposal->firstItem() + $index }}</td>

                                <td class="py-3.5 px-5">
                                    <span
                                        class="font-mono text-sm font-medium text-gray-700">{{ $item->kode_proposal }}</span>
                                </td>

                                <td class="py-3.5 px-5">
                                    <div class="flex items-center space-x-3.5">
                                        <div class="relative flex-shrink-0">
                                            <div
                                                class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-semibold text-sm shadow-sm bg-gradient-to-br from-indigo-500 to-purple-500">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800 text-sm truncate max-w-[200px]">
                                                {{ $item->judul }}
                                            </div>
                                            <div class="text-[10px] text-gray-400 flex items-center">
                                                <i class="far fa-clock mr-1"></i>
                                                {{ $item->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-3.5 px-5 text-gray-600 text-sm hidden lg:table-cell">
                                    <div class="flex items-center">
                                        <i class="fas fa-user-tie text-gray-300 mr-2.5 text-xs"></i>
                                        <span
                                            class="truncate max-w-[120px]">{{ $item->ketuaDosen->nama_dosen ?? '-' }}</span>
                                    </div>
                                </td>

                                <td class="py-3.5 px-5 text-gray-600 text-sm text-center hidden xl:table-cell">
                                    <span
                                        class="font-semibold text-emerald-600">{{ $item->dana_diusulkan_formatted }}</span>
                                </td>

                                <td class="py-3.5 px-5 text-center">
                                    {!! $item->status_badge !!}
                                </td>

                                <td class="py-3.5 px-5">
                                    <div class="flex items-center justify-center space-x-1">
                                        <a href="{{ route('admin.proposal.show', $item->id) }}"
                                            class="w-8 h-8 rounded-xl hover:bg-indigo-50 text-gray-400 hover:text-indigo-600 transition flex items-center justify-center group"
                                            title="Detail">
                                            <i class="fas fa-eye text-sm group-hover:scale-110 transition"></i>
                                        </a>

                                        <a href="{{ route('admin.proposal.edit', $item->id) }}"
                                            class="w-8 h-8 rounded-xl hover:bg-amber-50 text-gray-400 hover:text-amber-600 transition flex items-center justify-center group"
                                            title="Edit">
                                            <i class="fas fa-edit text-sm group-hover:scale-110 transition"></i>
                                        </a>

                                        <form action="{{ route('admin.proposal.destroy', $item->id) }}" method="POST"
                                            class="inline" onsubmit="return confirmDelete(this, '{{ $item->judul }}')">
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
                                <td colspan="7" class="py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center mb-4">
                                            <i class="fas fa-file-alt text-3xl text-gray-300"></i>
                                        </div>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada data proposal</p>
                                        <p class="text-sm text-gray-400 mt-1">Klik tombol "Tambah Proposal" untuk memulai
                                        </p>
                                        <a href="{{ route('admin.proposal.create') }}"
                                            class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-100 transition text-sm font-medium">
                                            <i class="fas fa-plus-circle mr-2"></i>
                                            Tambah Proposal Sekarang
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
                    Menampilkan <span class="font-semibold text-gray-700">{{ $proposal->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-700">{{ $proposal->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-700">{{ $proposal->total() }}</span>
                </div>
                <div>
                    {{ $proposal->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
