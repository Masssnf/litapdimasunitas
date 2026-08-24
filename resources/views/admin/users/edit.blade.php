@extends('layouts.admin')

@section('header', 'Edit User')

@section('content')
    <div class="space-y-5">

        <!-- ============================================= -->
        <!-- HERO HEADER                                   -->
        <!-- ============================================= -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-amber-500 via-amber-600 to-orange-600 rounded-2xl shadow-xl shadow-amber-500/20 p-6">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-orange-400/10 rounded-full blur-3xl"></div>

            <div class="relative flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center space-x-4">
                    <div
                        class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fas fa-user-edit text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Edit User</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-amber-100 text-sm">Ubah data user</span>
                            <span
                                class="px-2.5 py-0.5 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                {{ $user->name }}
                            </span>
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
                <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center">
                    <i class="fas fa-user-cog text-amber-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Form Edit User</h3>
                    <p class="text-xs text-gray-400">Ubah data user di bawah ini</p>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <!-- ✅ HIDDEN INPUT -->
                <input type="hidden" name="is_dosen" value="{{ $dosen ? 1 : 0 }}">
                <input type="hidden" name="is_reviewer" value="{{ $user->hasRole('reviewer') ? 1 : 0 }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
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
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                placeholder="Masukkan email" required>
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input type="password" name="password"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                placeholder="Kosongkan jika tidak diubah">
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Konfirmasi Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-check-circle text-gray-400"></i>
                            </div>
                            <input type="password" name="password_confirmation"
                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                placeholder="Ulangi password jika diubah">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Role <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-gray-400"></i>
                            </div>
                            <select name="role" id="role"
                                class="select2 w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                required>
                                <option value="">Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role', $user->getRoleNames()->first()) == $role->name ? 'selected' : '' }}>
                                        {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-toggle-on text-gray-400"></i>
                            </div>
                            <select name="status"
                                class="select2 w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                required>
                                <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="inactive"
                                    {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Nonaktif
                                </option>
                            </select>
                        </div>
                        @error('status')
                            <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <!-- ============================================= -->
                <!-- DATA DOSEN (Jika user memiliki dosen)        -->
                <!-- ============================================= -->
                @if ($dosen)
                    <div id="dosenContainer" class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700">Data Dosen</h4>
                                <p class="text-xs text-gray-400">Lengkapi data dosen</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- NIDN -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    NIDN <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-id-card text-gray-400"></i>
                                    </div>
                                    <input type="text" name="nidn" value="{{ old('nidn', $dosen->nidn) }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Contoh: 1234567890" required>
                                </div>
                                @error('nidn')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Jenis Kelamin <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-venus-mars text-gray-400"></i>
                                    </div>
                                    <select name="jenis_kelamin"
                                        class="select2 w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L"
                                            {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="P"
                                            {{ old('jenis_kelamin', $dosen->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                                @error('jenis_kelamin')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fakultas -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Fakultas <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-university text-gray-400"></i>
                                    </div>
                                    <select name="fakultas_id"
                                        class="select2 w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        required>
                                        <option value="">Pilih Fakultas</option>
                                        @foreach ($fakultas as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('fakultas_id', $dosen->fakultas_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_fakultas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('fakultas_id')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Prodi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Program Studi <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-book-open text-gray-400"></i>
                                    </div>
                                    <select name="prodi_id"
                                        class="select2 w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        required>
                                        <option value="">Pilih Program Studi</option>
                                        @foreach ($prodi as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('prodi_id', $dosen->prodi_id) == $item->id ? 'selected' : '' }}>
                                                {{ $item->nama_prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('prodi_id')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No Telepon Dosen -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    No Telepon Dosen
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="text" name="notelp_dosen"
                                        value="{{ old('notelp_dosen', $dosen->notelp_dosen) }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Contoh: 081234567890">
                                </div>
                                @error('notelp_dosen')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat Dosen -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Alamat Dosen
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <textarea name="alamat_dosen" rows="2"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Masukkan alamat lengkap">{{ old('alamat_dosen', $dosen->alamat_dosen) }}</textarea>
                                </div>
                                @error('alamat_dosen')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- ============================================= -->
                <!-- DATA REVIEWER (Jika user adalah reviewer)     -->
                <!-- ============================================= -->

                @if ($user->hasRole('reviewer'))
                    <div id="reviewerContainer" class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center">
                                <i class="fas fa-user-check text-amber-600"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-700">Data Reviewer</h4>
                                <p class="text-xs text-gray-400">Lengkapi data reviewer</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Kode Reviewer (WAJIB) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Kode Reviewer <span class="text-rose-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tag text-gray-400"></i>
                                    </div>
                                    <input type="text" name="kode_reviewer"
                                        value="{{ old('kode_reviewer', $reviewer ? $reviewer->kode_reviewer : '') }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Contoh: RV-001" {{ $reviewer ? 'required' : '' }}>
                                </div>
                                @error('kode_reviewer')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIDN Reviewer -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    NIDN Reviewer
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-id-card text-gray-400"></i>
                                    </div>
                                    <input type="text" name="nidn_reviewer"
                                        value="{{ old('nidn_reviewer', $reviewer ? $reviewer->nidn_reviewer : '') }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Contoh: 1234567890">
                                </div>
                                @error('nidn_reviewer')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Instansi -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Instansi
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-building text-gray-400"></i>
                                    </div>
                                    <input type="text" name="instansi_reviewer"
                                        value="{{ old('instansi_reviewer', $reviewer ? $reviewer->instansi_reviewer : '') }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Contoh: Universitas Islam Tasikmalaya">
                                </div>
                                @error('instansi_reviewer')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- No Telepon Reviewer -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    No Telepon Reviewer
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400"></i>
                                    </div>
                                    <input type="text" name="notelp_reviewer"
                                        value="{{ old('notelp_reviewer', $reviewer ? $reviewer->notelp_reviewer : '') }}"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Contoh: 081234567890">
                                </div>
                                @error('notelp_reviewer')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Alamat Reviewer (Full Width) -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Alamat Reviewer
                                </label>
                                <div class="relative">
                                    <div class="absolute top-3 left-3 pointer-events-none">
                                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                                    </div>
                                    <textarea name="alamat_reviewer" rows="2"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition"
                                        placeholder="Masukkan alamat lengkap">{{ old('alamat_reviewer', $reviewer ? $reviewer->alamat_reviewer : '') }}</textarea>
                                </div>
                                @error('alamat_reviewer')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis Reviewer (Full Width) -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Jenis Reviewer
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-tags text-gray-400"></i>
                                    </div>
                                    <select name="jenisreviewer_id"
                                        class="select2 w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                                        <option value="">Pilih Jenis Reviewer</option>
                                        @foreach ($jenisReviewer as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('jenisreviewer_id', $reviewer ? $reviewer->jenisreviewer_id : '') == $item->id ? 'selected' : '' }}>
                                                {{ $item->kode_jenisreviewer }} - {{ $item->nama_jenisreviewer }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('jenisreviewer_id')
                                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif

                <!-- ============================================= -->
                <!-- TOMBOL AKSI                                  -->
                <!-- ============================================= -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-6 py-2.5 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-xl hover:from-amber-600 hover:to-orange-600 transition-all duration-200 shadow-md shadow-amber-500/25 hover:shadow-lg hover:shadow-amber-500/30 text-sm font-medium">
                        <i class="fas fa-save mr-2"></i>
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
