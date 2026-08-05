<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kode Proposal</p>
        <p class="text-base font-semibold text-gray-800 mt-1 font-mono">{{ $proposal->kode_proposal }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Judul</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->judul }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Status</p>
        <div class="mt-1">{!! $proposal->status_badge !!}</div>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Dana Diusulkan</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->dana_diusulkan_formatted }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Tanggal Pengajuan</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->tanggal_pengajuan_formatted }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Ketua Dosen</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->ketuaDosen->nama_dosen ?? '-' }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Fakultas</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->fakultas->nama_fakultas ?? '-' }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Program Studi</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->prodi->nama_prodi ?? '-' }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Bidang Penelitian</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->bidangPenelitian->nama_bidang ?? '-' }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Periode Skema</p>
        <p class="text-base font-semibold text-gray-800 mt-1">
            {{ $proposal->periodeSkema->periode->nama_periode ?? '-' }} -
            {{ $proposal->periodeSkema->skema->nama_skema ?? '-' }}</p>
    </div>
    <div class="bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Kata Kunci</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->kata_kunci ?? '-' }}</p>
    </div>
    <div class="md:col-span-2 bg-gray-50/50 rounded-xl p-4">
        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider">Ringkasan</p>
        <p class="text-base font-semibold text-gray-800 mt-1">{{ $proposal->ringkasan ?? '-' }}</p>
    </div>
</div>
