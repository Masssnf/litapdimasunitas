<div>
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-sm font-semibold text-gray-700">Daftar Dokumen</h4>
        <a href="{{ route('admin.proposal.dokumen.create', $proposal->id) }}"
            class="px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 text-xs">
            <i class="fas fa-upload mr-1"></i>Upload Dokumen
        </a>
    </div>

    @if ($proposal->dokumen->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Jenis Dokumen</th>
                        <th class="px-4 py-2 text-left">Nama File</th>
                        <th class="px-4 py-2 text-center">Versi</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->dokumen as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-0.5 rounded-full text-xs bg-blue-100 text-blue-700">
                                    {{ ucfirst($item->jenis_dokumen) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $item->nama_file_asli }}</td>
                            <td class="px-4 py-2 text-center">
                                <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-700">
                                    v{{ $item->versi }}
                                </span>
                                @if ($item->is_latest)
                                    <span
                                        class="ml-1 px-1.5 py-0.5 rounded-full text-[9px] bg-emerald-100 text-emerald-700">Terbaru</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                @php
                                    $statusColors = [
                                        'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                        'Valid' => 'bg-emerald-100 text-emerald-700',
                                        'Revisi' => 'bg-orange-100 text-orange-700',
                                    ];
                                @endphp
                                <span
                                    class="px-2 py-0.5 rounded-full text-xs {{ $statusColors[$item->status_verifikasi] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $item->status_verifikasi }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('admin.proposal.dokumen.download', [$proposal->id, $item->id]) }}"
                                    class="text-indigo-500 hover:text-indigo-700 mr-2" title="Download">
                                    <i class="fas fa-download"></i>
                                </a>
                                @if ($proposal->status == 'Draft' || $proposal->status == 'Revisi')
                                    <a href="{{ route('admin.proposal.dokumen.edit', [$proposal->id, $item->id]) }}"
                                        class="text-amber-500 hover:text-amber-700 mr-2" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ route('admin.proposal.dokumen.destroy', [$proposal->id, $item->id]) }}"
                                        method="POST" class="inline"
                                        onsubmit="return confirmDelete(this, '{{ $item->nama_file }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-500 hover:text-rose-700" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3 text-xs text-gray-400">
            Total: {{ $proposal->dokumen->count() }} dokumen
        </div>
    @else
        <div class="text-center py-6 text-gray-500">
            <i class="fas fa-file-pdf text-3xl text-gray-300 mb-2 block"></i>
            <p>Belum ada dokumen</p>
            <p class="text-sm text-gray-400 mt-1">Klik tombol "Upload Dokumen" untuk menambahkan</p>
        </div>
    @endif
</div>
