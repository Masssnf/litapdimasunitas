@extends('layouts.admin')

@section('header', 'Manajemen User')

@section('content')
    <div class="space-y-5">

        <!-- HERO HEADER -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-purple-600 via-purple-500 to-pink-600 rounded-2xl shadow-xl shadow-purple-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-pink-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-users-cog text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Manajemen User</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-purple-100 text-sm">Kelola semua pengguna sistem</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $users->total() }} User
                            </span>
                        </div>
                    </div>
                </div>

                @can('create_users')
                    <a href="{{ route('admin.users.create') }}"
                        class="group relative px-5 py-2.5 bg-white text-purple-600 font-semibold rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 flex items-center text-sm overflow-hidden">
                        <span
                            class="absolute inset-0 bg-gradient-to-r from-purple-50 to-pink-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center">
                            <i class="fas fa-plus-circle mr-2 group-hover:rotate-90 transition-transform duration-300"></i>
                            Tambah User
                        </span>
                    </a>
                @endcan
            </div>
        </div>

        <!-- STATISTIK CARD -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">Total User</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/25">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <span class="text-xs text-gray-400">Total seluruh user</span>
                </div>
            </div>

            <div
                class="bg-white rounded-2xl shadow-sm border border-gray-100/80 p-5 hover:shadow-md transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">User Aktif</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $aktif }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                        <i class="fas fa-check-circle text-white text-lg"></i>
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
                        <p class="text-sm text-gray-500 font-medium">User Tidak Aktif</p>
                        <p class="text-2xl font-bold text-rose-600 mt-1">{{ $nonaktif }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-rose-500 to-rose-600 rounded-xl flex items-center justify-center shadow-lg shadow-rose-500/25">
                        <i class="fas fa-times-circle text-white text-lg"></i>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-t border-gray-100">
                    <span class="text-xs text-rose-500">● Status nonaktif</span>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

            <!-- Toolbar -->
            <div class="px-5 py-3.5 border-b border-gray-100 flex flex-wrap justify-between items-center gap-3">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Total:</span>
                        <span class="text-sm font-bold text-gray-800">{{ $users->total() }}</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="flex items-center space-x-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                            <span class="text-xs text-gray-400">Aktif: {{ $aktif }}</span>
                        </span>
                        <span class="flex items-center space-x-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-400"></span>
                            <span class="text-xs text-gray-400">Nonaktif: {{ $nonaktif }}</span>
                        </span>
                    </div>
                </div>

                <div class="flex items-center space-x-2">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center space-x-2">
                        <div class="relative">
                            <i class="fas fa-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user..."
                                class="pl-9 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-purple-400/30 focus:border-purple-300 focus:bg-white transition-all duration-200 w-40 focus:w-52 text-gray-700 placeholder:text-gray-400">
                        </div>
                        <button type="submit"
                            class="w-9 h-9 rounded-xl bg-purple-500 hover:bg-purple-600 text-white transition flex items-center justify-center">
                            <i class="fas fa-search text-sm"></i>
                        </button>
                        @if (request('search'))
                            <a href="{{ route('admin.users.index') }}"
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
                            <th class="py-3.5 px-5 text-left">Nama</th>
                            <th class="py-3.5 px-5 text-left hidden lg:table-cell">Email</th>
                            <th class="py-3.5 px-5 text-left">Role</th>
                            <th class="py-3.5 px-5 text-center">Status</th>
                            <th class="py-3.5 px-5 text-center w-44">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($users as $index => $item)
                            <tr class="hover:bg-purple-50/30 transition duration-200 group">
                                <td class="py-3.5 px-5 text-gray-400 text-sm text-center font-mono">
                                    {{ $users->firstItem() + $index }}</td>

                                <td class="py-3.5 px-5">
                                    <div class="flex items-center space-x-3.5">
                                        <div class="relative flex-shrink-0">
                                            <div
                                                class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-semibold text-sm shadow-sm bg-gradient-to-br from-purple-500 to-pink-500">
                                                {{ $item->initial }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800 text-sm">
                                                {{ $item->name }}
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
                                        <i class="fas fa-envelope text-gray-300 mr-2.5 text-xs"></i>
                                        <span class="truncate max-w-[180px]">{{ $item->email }}</span>
                                    </div>
                                </td>

                                <td class="py-3.5 px-5">
                                    {!! $item->role_badge !!}
                                </td>

                                <td class="py-3.5 px-5 text-center">
                                    {!! $item->status_badge !!}
                                </td>

                                <td class="py-3.5 px-5">
                                    <div class="flex items-center justify-center space-x-1">
                                        <a href="{{ route('admin.users.show', $item->id) }}"
                                            class="w-8 h-8 rounded-xl hover:bg-purple-50 text-gray-400 hover:text-purple-600 transition flex items-center justify-center group"
                                            title="Detail">
                                            <i class="fas fa-eye text-sm group-hover:scale-110 transition"></i>
                                        </a>

                                        @can('edit_users')
                                            <a href="{{ route('admin.users.edit', $item->id) }}"
                                                class="w-8 h-8 rounded-xl hover:bg-amber-50 text-gray-400 hover:text-amber-600 transition flex items-center justify-center group"
                                                title="Edit">
                                                <i class="fas fa-edit text-sm group-hover:scale-110 transition"></i>
                                            </a>
                                        @endcan

                                        @if ($item->id !== auth()->id())
                                            <form action="{{ route('admin.users.toggle-status', $item->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirmToggle(this, '{{ $item->name }}', '{{ $item->status === 'active' ? 'nonaktifkan' : 'aktifkan' }}')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-xl hover:bg-{{ $item->status === 'active' ? 'rose' : 'emerald' }}-50 text-gray-400 hover:text-{{ $item->status === 'active' ? 'rose' : 'emerald' }}-600 transition flex items-center justify-center group"
                                                    title="{{ $item->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    <i
                                                        class="fas {{ $item->status === 'active' ? 'fa-user-slash' : 'fa-user-check' }} text-sm group-hover:scale-110 transition"></i>
                                                </button>
                                            </form>

                                            @can('delete_users')
                                                <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
                                                    class="inline"
                                                    onsubmit="return confirmDelete(this, '{{ $item->name }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-8 h-8 rounded-xl hover:bg-rose-50 text-gray-400 hover:text-rose-600 transition flex items-center justify-center group"
                                                        title="Hapus">
                                                        <i class="fas fa-trash text-sm group-hover:scale-110 transition"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-20 h-20 rounded-2xl bg-gray-50 flex items-center justify-center mb-4">
                                            <i class="fas fa-users-slash text-3xl text-gray-300"></i>
                                        </div>
                                        <p class="text-gray-600 font-semibold text-lg">Belum ada data user</p>
                                        <p class="text-sm text-gray-400 mt-1">Klik tombol "Tambah User" untuk memulai</p>
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
                    Menampilkan <span class="font-semibold text-gray-700">{{ $users->firstItem() ?? 0 }}</span>
                    - <span class="font-semibold text-gray-700">{{ $users->lastItem() ?? 0 }}</span>
                    dari <span class="font-semibold text-gray-700">{{ $users->total() }}</span>
                </div>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
