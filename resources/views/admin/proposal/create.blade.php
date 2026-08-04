@extends('layouts.admin')

@section('header', 'Tambah Proposal')

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
                        <i class="fas fa-plus-circle text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white tracking-tight">Tambah Proposal</h1>
                        <div class="flex items-center space-x-3 mt-0.5">
                            <span class="text-indigo-100 text-sm">Tambahkan data proposal baru</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.proposal.index') }}"
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
                <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                    <i class="fas fa-file-alt text-indigo-600"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700">Form Proposal</h3>
                    <p class="text-xs text-gray-400">Lengkapi data proposal di bawah ini</p>
                </div>
            </div>

            <form action="{{ route('admin.proposal.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <!-- ============================================= -->
                <!-- 1. DATA PROPOSAL                            -->
                <!-- ============================================= -->
                <div class="border-b border-gray-200 pb-4 mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <i class="fas fa-file-alt text-indigo-500"></i>
                        Data Proposal
                    </h3>
                    <p class="text-sm text-gray-500">Lengkapi data proposal di bawah ini</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Kode Proposal <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="kode_proposal" value="{{ old('kode_proposal') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('kode_proposal')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Judul <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('judul')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Dana Diusulkan
                        </label>
                        <input type="number" name="dana_diusulkan" value="{{ old('dana_diusulkan') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="10000000" min="0" step="1000">
                        @error('dana_diusulkan')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Tanggal Pengajuan <span class="text-rose-500">*</span>
                        </label>
                        <input type="date" name="tanggal_pengajuan" value="{{ old('tanggal_pengajuan') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @error('tanggal_pengajuan')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Status <span class="text-rose-500">*</span>
                        </label>
                        <select name="status"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="diajukan" {{ old('status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="direview" {{ old('status') == 'direview' ? 'selected' : '' }}>Di Review</option>
                            <option value="diterima" {{ old('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="revisi" {{ old('status') == 'revisi' ? 'selected' : '' }}>Revisi</option>
                        </select>
                        @error('status')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Periode Skema <span class="text-rose-500">*</span>
                        </label>
                        <select name="periode_skema_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Periode Skema</option>
                            @foreach ($periodeSkema as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('periode_skema_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->periode->kode_periode ?? '' }} - {{ $item->skema->nama_skema ?? '' }}
                                </option>
                            @endforeach
                        </select>
                        @error('periode_skema_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Ketua Dosen <span class="text-rose-500">*</span>
                        </label>
                        <select name="ketua_dosen_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Ketua Dosen</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('ketua_dosen_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nidn }} - {{ $item->nama_dosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('ketua_dosen_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Bidang Penelitian <span class="text-rose-500">*</span>
                        </label>
                        <select name="bidangpenelitian_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Bidang Penelitian</option>
                            @foreach ($bidangPenelitian as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('bidangpenelitian_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_bidang }} - {{ $item->nama_bidang }}
                                </option>
                            @endforeach
                        </select>
                        @error('bidangpenelitian_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Fakultas <span class="text-rose-500">*</span>
                        </label>
                        <select name="fakultas_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Fakultas</option>
                            @foreach ($fakultas as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('fakultas_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_fakultas }} - {{ $item->nama_fakultas }}
                                </option>
                            @endforeach
                        </select>
                        @error('fakultas_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Program Studi <span class="text-rose-500">*</span>
                        </label>
                        <select name="prodi_id"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}" {{ old('prodi_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->kode_prodi }} - {{ $item->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        @error('prodi_id')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Ringkasan & Kata Kunci -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Ringkasan</label>
                        <textarea name="ringkasan" rows="3"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('ringkasan') }}</textarea>
                        @error('ringkasan')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Kata Kunci</label>
                        <input type="text" name="kata_kunci" value="{{ old('kata_kunci') }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Pendidikan, Karakter, Sekolah">
                        @error('kata_kunci')
                            <p class="text-rose-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ============================================= -->
                <!-- 2. ANGGOTA TIM                              -->
                <!-- ============================================= -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-users text-indigo-500"></i>
                            Anggota Tim
                        </h4>
                        <button type="button" id="addAnggota"
                            class="px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 text-sm">
                            <i class="fas fa-plus mr-1"></i>Tambah Anggota
                        </button>
                    </div>

                    <div id="anggotaContainer">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 anggota-row mb-3">
                            <div>
                                <select name="anggota[0][dosen_id]" class="select2 w-full rounded-xl border-gray-300">
                                    <option value="">Pilih Dosen</option>
                                    @foreach ($dosen as $item)
                                        <option value="{{ $item->id }}">{{ $item->nidn }} -
                                            {{ $item->nama_dosen }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select name="anggota[0][peran]" class="w-full rounded-xl border-gray-300">
                                    <option value="anggota">Anggota</option>
                                    <option value="ketua">Ketua</option>
                                </select>
                            </div>
                            <div class="flex items-center">
                                <button type="button" class="remove-anggota text-rose-500 hover:text-rose-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================= -->
                <!-- 3. MAHASISWA                                 -->
                <!-- ============================================= -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-user-graduate text-indigo-500"></i>
                            Mahasiswa
                        </h4>
                        <button type="button" id="addMahasiswa"
                            class="px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 text-sm">
                            <i class="fas fa-plus mr-1"></i>Tambah Mahasiswa
                        </button>
                    </div>

                    <div id="mahasiswaContainer">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mahasiswa-row mb-3">
                            <div>
                                <input type="text" name="mahasiswa[0][nim]" placeholder="NIM"
                                    class="w-full rounded-xl border-gray-300">
                            </div>
                            <div>
                                <input type="text" name="mahasiswa[0][nama_mahasiswa]" placeholder="Nama Mahasiswa"
                                    class="w-full rounded-xl border-gray-300">
                            </div>
                            <div>
                                <input type="text" name="mahasiswa[0][prodi_mahasiswa]" placeholder="Program Studi"
                                    class="w-full rounded-xl border-gray-300">
                            </div>
                            <div class="flex items-center">
                                <button type="button" class="remove-mahasiswa text-rose-500 hover:text-rose-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ============================================= -->
                <!-- 4. DOKUMEN                                  -->
                <!-- ============================================= -->
                <div class="border-t border-gray-200 pt-4 mt-4">
                    <div class="flex justify-between items-center mb-3">
                        <h4 class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                            <i class="fas fa-file-pdf text-indigo-500"></i>
                            Dokumen
                        </h4>
                        <button type="button" id="addDokumen"
                            class="px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 text-sm">
                            <i class="fas fa-plus mr-1"></i>Tambah Dokumen
                        </button>
                    </div>

                    <div id="dokumenContainer">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 dokumen-row mb-3">
                            <div>
                                <select name="dokumen[0][jenis_dokumen]" class="w-full rounded-xl border-gray-300">
                                    <option value="">Pilih Jenis</option>
                                    <option value="proposal">Proposal</option>
                                    <option value="surat_pengantar">Surat Pengantar</option>
                                    <option value="cv_ketua">CV Ketua</option>
                                    <option value="cv_anggota">CV Anggota</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div>
                                <input type="file" name="dokumen[0][file]"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <a href="{{ route('admin.proposal.index') }}" class="px-6 py-2.5 border rounded-xl">Batal</a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl">
                        <i class="fas fa-save mr-2"></i>Simpan Proposal
                    </button>
                </div>
            </form>
        </div>
    </div>

@section('scripts')
    <script>
        $(document).ready(function() {
            let anggotaIndex = 1;
            let mahasiswaIndex = 1;
            let dokumenIndex = 1;

            // =============================================
            // TAMBAH ANGGOTA
            // =============================================
            $('#addAnggota').on('click', function() {
                const html = `
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 anggota-row mb-3">
                    <div>
                        <select name="anggota[${anggotaIndex}][dosen_id]" class="select2 w-full rounded-xl border-gray-300">
                            <option value="">Pilih Dosen</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}">{{ $item->nidn }} - {{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="anggota[${anggotaIndex}][peran]" class="w-full rounded-xl border-gray-300">
                            <option value="anggota">Anggota</option>
                            <option value="ketua">Ketua</option>
                        </select>
                    </div>
                    <div class="flex items-center">
                        <button type="button" class="remove-anggota text-rose-500 hover:text-rose-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
                $('#anggotaContainer').append(html);
                $('.select2').select2({
                    width: '100%'
                });
                anggotaIndex++;
            });

            $(document).on('click', '.remove-anggota', function() {
                if ($('.anggota-row').length > 1) {
                    $(this).closest('.anggota-row').remove();
                } else {
                    Swal.fire('Info', 'Minimal harus ada 1 anggota', 'info');
                }
            });

            // =============================================
            // TAMBAH MAHASISWA
            // =============================================
            $('#addMahasiswa').on('click', function() {
                const html = `
                <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mahasiswa-row mb-3">
                    <div>
                        <input type="text" name="mahasiswa[${mahasiswaIndex}][nim]" placeholder="NIM" class="w-full rounded-xl border-gray-300">
                    </div>
                    <div>
                        <input type="text" name="mahasiswa[${mahasiswaIndex}][nama_mahasiswa]" placeholder="Nama Mahasiswa" class="w-full rounded-xl border-gray-300">
                    </div>
                    <div>
                        <input type="text" name="mahasiswa[${mahasiswaIndex}][prodi_mahasiswa]" placeholder="Program Studi" class="w-full rounded-xl border-gray-300">
                    </div>
                    <div class="flex items-center">
                        <button type="button" class="remove-mahasiswa text-rose-500 hover:text-rose-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
                $('#mahasiswaContainer').append(html);
                mahasiswaIndex++;
            });

            $(document).on('click', '.remove-mahasiswa', function() {
                if ($('.mahasiswa-row').length > 1) {
                    $(this).closest('.mahasiswa-row').remove();
                } else {
                    Swal.fire('Info', 'Minimal harus ada 1 mahasiswa', 'info');
                }
            });

            // =============================================
            // TAMBAH DOKUMEN
            // =============================================
            $('#addDokumen').on('click', function() {
                const html = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 dokumen-row mb-3">
                    <div>
                        <select name="dokumen[${dokumenIndex}][jenis_dokumen]" class="w-full rounded-xl border-gray-300">
                            <option value="">Pilih Jenis</option>
                            <option value="proposal">Proposal</option>
                            <option value="surat_pengantar">Surat Pengantar</option>
                            <option value="cv_ketua">CV Ketua</option>
                            <option value="cv_anggota">CV Anggota</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <input type="file" name="dokumen[${dokumenIndex}][file]" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>
            `;
                $('#dokumenContainer').append(html);
                dokumenIndex++;
            });

            $(document).on('click', '.remove-dokumen', function() {
                if ($('.dokumen-row').length > 1) {
                    $(this).closest('.dokumen-row').remove();
                } else {
                    Swal.fire('Info', 'Minimal harus ada 1 dokumen', 'info');
                }
            });
        });
    </script>
@endsection
@endsection
