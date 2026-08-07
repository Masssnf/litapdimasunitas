@extends('layouts.admin')

@section('header', 'Detail User')

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
                        <i class="fas fa-user-circle text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Detail User</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-purple-100 text-sm">Informasi lengkap user</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $user->name }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    @can('edit_users')
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                            class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                    @endcan
                    <a href="{{ route('admin.users.index') }}"
                        class="px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- ============================================= -->
        <!-- CONTENT                                      -->
        <!-- ============================================= -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- Kolom Kiri - Data User -->
            <div class="lg:col-span-2">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-info-circle text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Data User</h3>
                            <p class="text-xs text-gray-400">Informasi lengkap user</p>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <div
                                class="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center text-2xl font-bold text-white shadow-lg">
                                {{ $user->initial }}
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                                <div class="flex items-center gap-2 mt-1">
                                    {!! $user->role_badge !!}
                                    {!! $user->status_badge !!}
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Nama Lengkap</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $user->name }}</p>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $user->email }}</p>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Role</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">{{ $user->role_label }}</p>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
                                <div class="mt-1">{!! $user->status_badge !!}</div>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Bergabung</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $user->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="bg-gray-50/50 rounded-xl p-4">
                                <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Terakhir Diubah</p>
                                <p class="text-base font-semibold text-gray-800 mt-1">
                                    {{ $user->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan - Aksi Cepat -->
            <div class="space-y-5">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center">
                            <i class="fas fa-bolt text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700">Aksi Cepat</h3>
                            <p class="text-xs text-gray-400">Kelola data user</p>
                        </div>
                    </div>

                    <div class="p-4 space-y-2">
                        @can('edit_users')
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 transition-colors duration-200">
                                <i class="fas fa-edit text-amber-500"></i>
                                <span class="text-sm font-medium">Edit Data User</span>
                            </a>
                        @endcan

                        @if ($user->id !== auth()->id())
                            <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST"
                                class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl {{ $user->status === 'active' ? 'bg-rose-50 text-rose-700 hover:bg-rose-100' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100' }} transition-colors duration-200">
                                    <i
                                        class="fas {{ $user->status === 'active' ? 'fa-user-slash' : 'fa-user-check' }} text-{{ $user->status === 'active' ? 'rose' : 'emerald' }}-500"></i>
                                    <span
                                        class="text-sm font-medium">{{ $user->status === 'active' ? 'Nonaktifkan User' : 'Aktifkan User' }}</span>
                                </button>
                            </form>

                            @can('delete_users')
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="w-full"
                                    onsubmit="return confirmDelete(this, '{{ $user->name }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center gap-3 w-full px-4 py-2.5 rounded-xl bg-rose-50 text-rose-700 hover:bg-rose-100 transition-colors duration-200">
                                        <i class="fas fa-trash text-rose-500"></i>
                                        <span class="text-sm font-medium">Hapus User</span>
                                    </button>
                                </form>
                            @endcan
                        @endif
                    </div>
                </div>

                <!-- Info Dosen (Jika ada) -->
                @if ($user->dosen)
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-700">Data Dosen</h3>
                                <p class="text-xs text-gray-400">Informasi dosen terkait</p>
                            </div>
                        </div>
                        <div class="p-4 space-y-3">
                            <div>
                                <p class="text-xs text-gray-400">NIDN</p>
                                <p class="font-semibold text-gray-800">{{ $user->dosen->nidn }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Fakultas</p>
                                <p class="font-semibold text-gray-800">{{ $user->dosen->fakultas->nama_fakultas ?? '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Program Studi</p>
                                <p class="font-semibold text-gray-800">{{ $user->dosen->prodi->nama_prodi ?? '-' }}</p>
                            </div>
                            <a href="{{ route('admin.dosen.show', $user->dosen->id) }}"
                                class="flex items-center justify-center w-full px-4 py-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-100 transition text-sm font-medium">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail Dosen
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
