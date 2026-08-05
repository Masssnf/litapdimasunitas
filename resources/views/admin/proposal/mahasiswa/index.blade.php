<div>
    <div class="flex justify-between items-center mb-4">
        <h4 class="text-sm font-semibold text-gray-700">Daftar Mahasiswa</h4>
        <a href="{{ route('admin.proposal.mahasiswa.create', $proposal->id) }}"
            class="px-3 py-1.5 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 text-xs">
            <i class="fas fa-plus mr-1"></i>Tambah Mahasiswa
        </a>
    </div>

    @if ($proposal->mahasiswa->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">NIM</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Program Studi</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proposal->mahasiswa as $index => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $item->nim }}</td>
                            <td class="px-4 py-2">{{ $item->nama_mahasiswa }}</td>
                            <td class="px-4 py-2">{{ $item->prodi_mahasiswa }}</td>
                            <td class="px-4 py-2 text-center">
                                <a href="{{ route('admin.proposal.mahasiswa.edit', [$proposal->id, $item->id]) }}"
                                    class="text-amber-500 hover:text-amber-700 mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form
                                    action="{{ route('admin.proposal.mahasiswa.destroy', [$proposal->id, $item->id]) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirmDelete(this, '{{ $item->nama_mahasiswa }}')">
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
            <i class="fas fa-user-graduate text-3xl text-gray-300 mb-2 block"></i>
            <p>Belum ada mahasiswa</p>
        </div>
    @endif
</div>
