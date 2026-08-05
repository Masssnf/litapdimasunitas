<div>
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-sm font-semibold text-gray-700">Daftar Reviewer</h4>
        <a href="{{ route('admin.proposal.reviewer.create', $proposal->id) }}"
            class="px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 text-xs">
            <i class="fas fa-plus mr-1"></i>Tugaskan Reviewer
        </a>
    </div>

    @if ($proposal->reviewer->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nama Reviewer</th>
                        <th class="px-4 py-2 text-left">Instansi</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Tanggal Tugas</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->reviewer as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $item->reviewer->nama_reviewer ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->reviewer->instansi_reviewer ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">{!! $item->status_badge !!}</td>
                            <td class="px-4 py-2 text-center">
                                {{ $item->tanggal_penugasan ? date('d/m/Y', strtotime($item->tanggal_penugasan)) : '-' }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('admin.proposal.reviewer.edit', [$proposal->id, $item->id]) }}"
                                    class="text-amber-500 hover:text-amber-700 mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form
                                    action="{{ route('admin.proposal.reviewer.destroy', [$proposal->id, $item->id]) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirmDelete(this, '{{ $item->reviewer->nama_reviewer ?? '' }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-500 hover:text-rose-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-6 text-gray-500">
            <i class="fas fa-user-check text-3xl text-gray-300 mb-2 block"></i>
            <p>Belum ada reviewer ditugaskan</p>
            <p class="text-sm text-gray-400 mt-1">Klik tombol "Tugaskan Reviewer" untuk menambahkan</p>
        </div>
    @endif
</div>
