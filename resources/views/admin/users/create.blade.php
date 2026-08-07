@extends('layouts.admin')

@section('header', 'Tambah User')

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
                        <i class="fas fa-user-plus text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah User</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-purple-100 text-sm">Tambahkan pengguna baru ke sistem</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.users.index') }}"
                    class="group relative px-5 py-2.5 bg-white/20 backdrop-blur-sm text-white font-semibold rounded-xl hover:bg-white/30 transition-all duration-300 flex items-center text-sm border border-white/20">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- ============================================= -->
        <!-- FORM                                         -->
        <!-- ============================================= -->
        <div
            class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden transition-all hover:shadow-md">

            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-user-cog text-purple-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Form Tambah User</h3>
                    <p class="text-xs text-gray-400">Lengkapi data user di bawah ini</p>
                </div>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kolom Kiri -->
                    <!-- Nama -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                                placeholder="Masukkan nama lengkap" required>
                        </div>
                        @error('name')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Email <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                                placeholder="Masukkan email" required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Password <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                                placeholder="Minimal 8 karakter" required>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Konfirmasi Password <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-check-circle text-gray-400"></i>
                            </div>
                            <input type="password" name="password_confirmation"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                                placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-4">
                        <!-- Role -->
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Role <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-400"></i>
                                </div>
                                <select name="role"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                                    required>
                                    <option value="">Pilih Role</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Role <span class="text-rose-500">*</span>
                            </label>
                            <select name="role" id="role" class="select2 w-full" data-placeholder="Pilih Role"
                                data-allow-clear="false" data-search="-1" required>
                                <option value="">Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Status -->
                        {{-- <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                Status <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-toggle-on text-gray-400"></i>
                                </div>
                                <select name="status"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition"
                                    required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>✅ Aktif
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>❌ Nonaktif
                                    </option>
                                </select>
                            </div>
                            @error('status')
                                <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select name="status" id="status" class="select2 w-full "
                            data-placeholder="Pilih Status" data-allow-clear="false" data-search="-1" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-rose-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    </div>
                    <!-- Info Role -->
                    <div class="bg-purple-50 rounded-xl p-4 border border-purple-100">
                        <h4 class="text-sm font-semibold text-purple-700 mb-2">
                            <i class="fas fa-info-circle mr-1"></i> Informasi Role
                        </h4>
                        <ul class="text-xs text-purple-600 space-y-1">
                            <li><span class="font-medium">Super Admin:</span> Akses penuh ke seluruh sistem</li>
                            <li><span class="font-medium">Admin LPPM:</span> Kelola proposal, reviewer, laporan</li>
                            <li><span class="font-medium">Reviewer:</span> Menilai proposal yang ditugaskan</li>
                            <li><span class="font-medium">Dosen:</span> Mengajukan proposal</li>
                        </ul>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl hover:from-purple-600 hover:to-pink-600 transition-all duration-200 shadow-md shadow-purple-500/25 hover:shadow-lg hover:shadow-purple-500/30 text-sm font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
